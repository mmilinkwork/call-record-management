## High-level description

This is an ETL (Extract–Transform–Load) file processing system with pluggable strategy-based pipelines per file type.

More precisely:
    It is a strategy-driven file import framework that transforms raw positional file data into: 
    validated, normalized, and domain-ready records for database persistence.

## Architecture overview
- [File ingestion layer]
  - Reads raw file rows from txt files.
  - Streams data into the processing pipeline.
  - Delegates further processing to the application layer.

- [Mapping layer (Transformation)]
  - Converts raw data rows → structured objects/arrays.
  - Uses Strategy/Mapper per record type (CallRecord, ConfirmationRecord).
  - Define file format for next processes.

- [Validation layer (Rule enforcement)]
    - Applies business rules per record type -> basic validation for required types and fields.
    - Uses Strategy-based validation depending on file type that we process.
    - Produces validation result with valid and invalid records.

- [Normalization layer (Business rules)]
    - Applies cross-field and dependency-based transformations.
    - Handles business-specific corrections (field interdependencies, computed values, overrides).
    - Outputs normalized records ready for persistence.

- [Manager layer (Database injection)]
    - Handles bulk database insertion.
    - Uses strategy-based managers per record type or workflow.
    - Ensures efficient and scalable writes for large datasets.

## Asynchronous processing model
    The system is designed around queue-based job processing, enabling:
        - Chunked processing of large files
        - Horizontal scalability
        - Isolation of processing steps
        - Fault tolerance and retry mechanisms
## Additional application features
    
    Beyond the ETL pipeline, the system also provides:
        - Simple UI for displaying ingested records
        - CRUD operations over processed data
        - PDF export functionality based on filtered datasets
