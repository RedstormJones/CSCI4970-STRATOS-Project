--
-- Unique Keys
--
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StPrsnInst', 5 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StLfeCyclConf', 4 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StAffLvlConf', 3 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StSvrLvlConf', 3 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StPriConf', 5 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StCatgConf', 49 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StTktInst', 0 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StEqpInst', 0 );
INSERT INTO `StNxtPriKeyInst` ( `table`, `key` ) VALUES ( 'StSftInst', 0 );

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
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `is_timed`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Open'			, 255, 102,   0,  TRUE, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `is_timed`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'In Progress'	,  51,   0, 255,  TRUE, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `is_timed`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'Closed'		,   0, 102,   0, FALSE, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StLfeCyclConf ( `life_cycl_id`, `name`, `r`, `g`, `b`, `is_timed`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'Waiting'		, 255, 255,  51, FALSE, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );

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

--
-- Categories
--

INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 0, 'Account Creation'				, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 1, 'Account previleges'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 2, 'AD'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 3, 'Backup'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 4, 'Checkout item'				, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 5, 'Course'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 6, 'Data'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 7, 'Database'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 8, 'Decommision'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 9, 'DNS'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 10, 'Documentation'				, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 11, 'Email'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 12, 'Hardware'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 13, 'HCC'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 14, 'HPC'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 15, 'Imaging'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 16, 'Inventory'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 17, 'IRC'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 18, 'Login'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 19, 'Logs'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 20, 'Misc'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 21, 'Move'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 22, 'Netowrk'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 23, 'Organize'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 24, 'OS Install'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 25, 'OS Upgrade'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 26, 'Other Account Related'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 27, 'Password'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 28, 'Permission'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 29, 'Printer'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 30, 'Public Relations'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 31, 'Purchase Request'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 32, 'Restricted Data'				, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 33, 'Room Access'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 34, 'Room Reservation'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 35, 'SCM'							, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 36, 'Security'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 37, 'Server'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 38, 'Software'					, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 39, 'SSL Certificate'				, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 40, 'Storage'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 41, 'Surplus'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 42, 'Systems Integration'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 43, 'Technical Specifications'	, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 44, 'Virus/Spyware/Malware'		, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 45, 'VMWARE'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 46, 'Website'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 47, 'Wiki'						, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
INSERT INTO StCatgConf ( `cid`, `name`, `logl_del`, `last_mdfd_user`, `last_mdfd_tmst` ) VALUES ( 48, 'Workstation Setup'			, FALSE, 'TestDataLoad', '2001-01-01 00:00:00' );
