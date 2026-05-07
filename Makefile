AddNumberToBatch :

	php artisan migrate --path=database/migrations/2024_08_07_044702_add_number_to_batches_table.php

UpdateLogBatchesUserIdToNullable :

	php artisan migrate --path=database/migrations/2024_08_12_090555_update_user_id_to_nullable_in_log_batches_table.php

UpdateLogEdocsUserIdToNullable :

	php artisan migrate --path=database/migrations/2024_08_12_093056_update_user_id_to_nullable_in_log_edocs_table.php

UpdateEdocStatusesUserIdToNullable :

	php artisan migrate --path=database/migrations/2024_08_12_094155_update_user_id_to_nullable_in_edoc_statuses_table.php

UpdateBatchStatusesUserIdToNullable :

	php artisan migrate --path=database/migrations/2024_08_12_094535_update_user_id_to_nullable_in_batch_statuses_table.php

IndexingCreatedAtInEdocStatuses : 

	php artisan migrate --path=database/migrations/2024_08_22_024221_indexing_created_at_in_edoc_statuses_table.php

UniqueLableInEdocs :

	php artisan migrate --path=database/migrations/2024_08_28_012805_uniqe_label_in_edocs_table.php

AddImageAndStatusToUsers :

	php artisan migrate --path=database/migrations/2024_08_29_014811_add_image_and_status_to_users_table.php

CreateEdocLabelSuggestionTable :

	php artisan migrate --path=database/migrations/2024_08_29_065714_create_edoc_label_suggestions_table.php

CreateApiKeyTable :

	php artisan migrate --path=database/migrations/2024_09_02_024241_create_api_keys_table.php