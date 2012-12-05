USE ts_equity;

ALTER TABLE customers
ADD campaign_id int NULL
AFTER last_status_code;

INSERT INTO list_values (group_id, list_data, list_code, sort_index)
VALUES (3, 'SPV', 7, 7);

INSERT INTO list_groups (group_name) VALUES ('New Customer Status');
SET @id = LAST_INSERT_ID();

INSERT INTO list_values (group_id, list_data, list_code, sort_index)
VALUES
(@id, 'DUPLICATE', -1, 0),
(@id, 'UPLOADED', 0, 1),
(@id, 'RECYCLE', 1, 2),
(@id, 'UNASSIGNED 1', 2, 3),
(@id, 'UNASSIGNED 2', 3, 4),
(@id, 'ASSIGNED', 4, 5),
(@id, 'PROCESSED', 5, 6),
(@id, 'PENDING', 6, 7),
(@id, 'INCOMPLETE', 7, 8),
(@id, 'COLLECTION', 8, 9),
(@id, 'UNCOLLECT', 9, 10),
(@id, 'CLOSED', 10, 11);