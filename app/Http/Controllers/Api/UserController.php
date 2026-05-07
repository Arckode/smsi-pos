<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Traits\DatabaseTrait;
use App\Models\ApiKey;
use App\Models\User;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use DatabaseTrait;

    private $errStatusCode;

    public function __construct()
    {
        $this->errStatusCode = 500;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $relations = [
                'unit:id,name',
            ];

            $users = User::with($relations)
                ->when(
                    $request->has('search') && $request->search != '',
                    function ($q) use ($request) {
                        $removeColumns = [
                            'id',
                            'unit_id',
                            'role',
                            'password',
                            'picture',
                            'is_active',
                            'email_verified_at',
                            'remember_token',
                            'created_at',
                            'updated_at',
                        ];

                        foreach ($this->getTableColumns('users', $removeColumns) as $value) {
                            $q->orWhere($value, 'like', '%' . $request->search . '%');
                        }

                        $q->orWhereHas('unit', function ($q1) use ($request) {
                            $q1->where('name', 'like', '%' . $request->search . '%');
                        });
                    }
                )
                ->when(
                    $request->has('unit') && $request->unit != null && $request->unit != '',
                    function (Builder $q) use ($request) {
                        $q->orWhereHas('unit', function ($q1) use ($request) {
                            $q1->where('id', '=', $request->unit);
                        });
                    }
                )
                ->paginate(10);

            return response()->json([
                'status' => true,
                'message' => 'Data Successfully Retrieved',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validatedReq = (object) $request->validated();

            $user = new User();

            $user->unit_id = $validatedReq->unit_id;
            $user->name = $validatedReq->name;
            $user->role = RoleType::USER->value;
            $user->email = $validatedReq->email;
            if (filter_var($validatedReq->erp, FILTER_VALIDATE_BOOL)) {
                $user->password = $validatedReq->password;
            } else {
                $user->password = Hash::make($validatedReq->password);
            }

            $link = '';

            if (isset($validatedReq->picture)) {
                $link = Storage::put('public/profile', $validatedReq->picture, 'public');
            }

            $user->picture = $link;

            $user->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Data has been saved"
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $relations = [
                "unit:id,name",
            ];

            $user = User::with($relations)->findOrFail($id);

            $user->role = [
                'code' => $user->role,
                'title' => RoleType::from($user->role)->name,
            ];

            return response()->json([
                'status' => true,
                'message' => 'Data Successfully Retrieved',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validatedReq = (object) $request->validated();

            if (auth()->user()->role == RoleType::SEKRETARIS->value) {
                $user = User::findOrFail($id);
            } else {
                $user = User::findOrFail(auth()->user()->id);
            }

            $user->unit_id = $validatedReq->unit_id;
            $user->name = $validatedReq->name;
            $user->email = $validatedReq->email;

            $link = '';
            $prevPhoto = null;

            if (isset($validatedReq->picture) && !is_string($validatedReq->picture)) {
                $prevPhoto = $user->getRawOriginal('picture');
                $link = Storage::put('public/profile', $validatedReq->picture, 'public');
            }

            $user->picture = $link ? $link : $user->getRawOriginal('picture');

            $user->save();

            if ($prevPhoto) {
                Storage::delete($prevPhoto);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data Has Been Updated'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->is_active = false;

            $user->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User Has Been Deactivated'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    public function activate(string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->is_active = true;

            $user->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User Has Been Activated'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    public function loadUser($unitId): JsonResponse
    {
        try {
            $data = [];

            $api = ApiKey::where('unit_id', $unitId)->first();

            if (!$api) {
                throw new \Exception("Unauthorized");
            }

            $headers = [
                'X-Authorization' => $api->key,
            ];

            /* Local Test */
            // $url = "http://erp-excel.test/api/v1/public/{$api->name}/users";

            $url = "{$api->url}/api/v1/public/{$api->name}/users";


            $response = Http::withHeaders($headers)->get($url);

            if ($response->successful()) {
                $users = $response->json()['data']['users'];

                $data = json_decode(Crypto::decrypt($users, Key::loadFromAsciiSafeString($api->encrypt_key)));
            }

            return response()->json([
                "status" => true,
                "data" => [
                    "users" => $data
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }

    public function options(Request $request): JsonResponse
    {
        try {
            $data = User::get();
            return response()->json([
                "status" => true,
                "data" => [
                    "users" => $data
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], $this->errStatusCode);
        }
    }
}
