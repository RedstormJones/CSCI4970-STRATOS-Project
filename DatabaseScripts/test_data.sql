--
-- Person entities
--
INSERT INTO StPrsnInst ( `pid`, `fname`, `lname`, `email`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Tyler'		, 'Filkins'	, 'tfilkins@fake.com'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPrsnInst ( `pid`, `fname`, `lname`, `email`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'Yumarzi'	, 'Khan'	, 'ymkhan@fake.com'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPrsnInst ( `pid`, `fname`, `lname`, `email`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'Jacob'		, 'Vosik'	, 'jacob.vosik@fake.com'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPrsnInst ( `pid`, `fname`, `lname`, `email`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'Hassan'	, 'Alradwan', 'halradwan@fake.com'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPrsnInst ( `pid`, `fname`, `lname`, `email`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4, 'Asad'		, 'Ullah'	, 'asadvasad@fake.com'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Phone entities
--
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0 , 'HOME', NULL, '402', '555', '0000', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0 , 'BUSN', NULL, '402', '555', '0001', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0 , 'CELL', NULL, '402', '555', '0002', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1 , 'HOME', NULL, '402', '555', '0003', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1 , 'BUSN', NULL, '402', '555', '0004', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1 , 'CELL', NULL, '402', '555', '0005', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2 , 'HOME', NULL, '402', '555', '0006', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2 , 'BUSN', NULL, '402', '555', '0007', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2 , 'CELL', NULL, '402', '555', '0008', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3 , 'HOME', NULL, '402', '555', '0009', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3 , 'BUSN', NULL, '402', '555', '0010', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3 , 'CELL', NULL, '402', '555', '0011', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4 , 'HOME', NULL, '402', '555', '0012', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4 , 'BUSN', NULL, '402', '555', '0013', 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPhneInst ( `pid`, `type`, `intl`, `area`, `phone1`, `phone2`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4 , 'CELL', NULL, '402', '555', '0014', 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- User entities
--
INSERT INTO StUserInst ( `pid`, `user`, `pass`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'tfilkins'	, 'changeme', FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StUserInst ( `pid`, `user`, `pass`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'ykhan'	, 'changeme', FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StUserInst ( `pid`, `user`, `pass`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'jvosik'	, 'changeme', FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StUserInst ( `pid`, `user`, `pass`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'halradwan', 'changeme', FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StUserInst ( `pid`, `user`, `pass`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4, 'aullah'	, 'changeme', FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Lifecycle configuration
--
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Open'			, 255, 102,   0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'In Progress'	,  51,   0, 255, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'Closed'		,   0, 102,   0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'Waiting'		, 255, 255,  51, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Affected level configuration
--
INSERT INTO StAffLvlConf ( `aff_level`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, '1 Person'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StAffLvlConf ( `aff_level`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, '2-5 People'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StAffLvlConf ( `aff_level`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, '6+ People'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Severity level configuration
--
INSERT INTO StSvrLvlConf ( `severity`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Trivial'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StSvrLvlConf ( `severity`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'Workaround Exists'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StSvrLvlConf ( `severity`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'No Workaround'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Priority configuration
--
INSERT INTO StPriConf ( `priority`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Very Low'	,   0, 153,  0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriConf ( `priority`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'Low'		,   0, 255,  0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriConf ( `priority`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'Medium'	, 255, 255,  0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriConf ( `priority`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'High'		, 255, 128,  0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriConf ( `priority`, `name`, `r`, `g`, `b`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4, 'Very High'	, 255,   0,  0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

--
-- Affected-Severity -> Priority configuration
--
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 0, 0, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 0, 1, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 0, 2, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 1, 1, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 1, 2, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 1, 3, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 2, 3, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 2, 3, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StPriMtxConf ( `aff_level`, `severity`, `priority`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 2, 4, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
