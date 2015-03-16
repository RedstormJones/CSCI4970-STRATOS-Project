-- 
-- Selects id and name of all categories
--		Use to populate the categories drop-down
-- 
SELECT
    cid, name
  FROM
    StCatgConf
  WHERE
    logl_del = FALSE;

-- 
-- Selects id and name of all severities
--		Use to populate the severity drop-down
-- 
SELECT
    severity, name
  FROM
    StSvrLvlConf
  WHERE
    logl_del = FALSE;

-- 
-- Selects id and name of all affected levels
--		Use to populate the affected levels drop-down
-- 
SELECT
    aff_level, name
  FROM
    StAffLvlConf
  WHERE
    logl_del = FALSE;

-- 
-- Selects id, name, and color of priority based on affected level and severity
--		Use to update the priority-viewer text box
--		Requires current Affected Level and Severity
-- 
SELECT
    priority, name, r, g, b
  FROM
    StPriMtxConf
  NATURAL JOIN
    StPriConf
  WHERE
    aff_level = <?>
      AND
    severity = <?>
      AND
    logl_del = FALSE;


-- 
-- Selects id and first and last name of all users
--		Use to populate the users drop-down
-- 
SELECT
    pid, fname, lname
  FROM
    StPrsnInst
  NATURAL JOIN
    StUserInst
  WHERE
    logl_del = FALSE;
    
-- 
-- Gets the next key to be used for the ticket table
--
SELECT 
	`key` 
  FROM 
    StNxtPriKeyInst 
  WHERE 
    `table`='StTktInst';
    
--
-- Updates the next key to be used for the ticket table
--		Requires the next key
--
UPDATE 
    StNxtPriKeyInst 
  SET 
    `key` = <?> 
  WHERE 
    `table`='StTktInst';
--
-- Inserts a new ticket based on form data
--		Requires a lot of parameters
--
INSERT INTO `StTktInst` ( 
  `tid`
, `opener`
, `assignee`
, `aff_level`
, `severity`
, `title`
, `description`
, `catg`
, `life_cycl_id`
, `insrt_tmst`
, `expct_hours`
, `last_open_time`
, `logl_del`
, `last_mdfd_user`
, `last_mdfd_tmst` 
) VALUES ( 
  <?>
, <CURRENT_USER_ID>
, <?>
, <?>
, <?>
, <?>
, <?>
, <?>
, 0
, <NOW>
, <?>
, 0
, FALSE
, '<CURRENT_USER_NAME'
, <NOW>
);
