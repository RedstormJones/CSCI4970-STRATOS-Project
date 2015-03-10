-- --------------------------------------------------------

-- Person Instance

CREATE TABLE IF NOT EXISTS `StPrsnInst` (
  `pid`									bigint(20)		NOT NULL		AUTO_INCREMENT
, `fname`								varchar(32)		NOT NULL
, `lname`								varchar(32)		NOT NULL
, `email`								varchar(64)						DEFAULT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime						DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`pid`)
, CONSTRAINT `StPrsnLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A person who may or may not be a user of the system';

-- --------------------------------------------------------

-- User Instance (Person with a login)

CREATE TABLE IF NOT EXISTS `StUserInst` (
  `pid`									bigint(20)		NOT NULL
, `user`								varchar(16)		NOT NULL
, `pass`								varchar(32)		NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, UNIQUE KEY `user` (`user`)
, CONSTRAINT `StUsrLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `stprsninst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StUsrToPrsnFrgnKey`				FOREIGN KEY (`pid`)				REFERENCES `stprsninst` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A user of the system';

-- --------------------------------------------------------

-- Phone Instance

CREATE TABLE IF NOT EXISTS `StPhneInst` (
  `pid`									bigint(20)		NOT NULL
, `type`								varchar(4)		NOT NULL
, `intl`								varchar(1)						DEFAULT NULL
, `area`								varchar(3)		NOT NULL
, `phone1`								varchar(3)		NOT NULL
, `phone2`								varchar(4)		NOT NULL
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, CONSTRAINT `StPhneLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StPhneToPrsnFrgnKey`				FOREIGN KEY (`pid`)				REFERENCES `StPrsnInst` (`pid`) ON DELETE CASCADE
, CONSTRAINT `StPhneType`						CHECK ( `type` in ('BUSN','HOME','CELL') )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A phone number associated with a person';

-- --------------------------------------------------------

-- Lifecycle Configuration

CREATE TABLE IF NOT EXISTS `StLfeCyclConf` (
  `life_cycl_id`						tinyint(4)		NOT NULL
, `name`								varchar(16)		NOT NULL
, `r`									tinyint(4)		NOT NULL
, `g`									tinyint(4)		NOT NULL
, `b`									tinyint(4)		NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`life_cycl_id`)
, UNIQUE KEY `name` (`name`)
, CONSTRAINT `StLfeCyclLastMdfdToPrsnFrgnKey`	FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Life cycle for tickets';

-- --------------------------------------------------------

-- Priority Configuration

CREATE TABLE IF NOT EXISTS `StPriConf` (
  `priority`							tinyint(4)		NOT NULL
, `name`								varchar(16)		NOT NULL
, `r`									tinyint(4)		NOT NULL
, `g`									tinyint(4)		NOT NULL
, `b`									tinyint(4)		NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`priority`)
, UNIQUE KEY (`name`)
, CONSTRAINT `StPriLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Different priority levels';

-- --------------------------------------------------------

-- (Affected,Severity) -> Priority 

CREATE TABLE IF NOT EXISTS `StPriMtxConf` (
  `aff_level`							tinyint(4)		NOT NULL
, `severity`							tinyint(4)		NOT NULL
, `priority`							tinyint(4)		NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`aff_level`,`severity`)
, KEY `last_mdfd_user` (`last_mdfd_user`)
, KEY `priority` (`priority`)
, CONSTRAINT `StPriMtxLastMdfdToPrsnFrgnKey`	FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StPriMtxToPriFrgnKey`				FOREIGN KEY (`priority`)		REFERENCES `StPriConf` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Matrix for num affected and severity to priority';

-- --------------------------------------------------------

-- Ticket instance

CREATE TABLE IF NOT EXISTS `StTktInst` (
  `tid`									bigint(20)		NOT NULL
, `opener`								bigint(20)		NOT NULL
, `assignee`							bigint(20)		NOT NULL
, `aff_level`							tinyint(4)		NOT NULL
, `severity`							tinyint(4)		NOT NULL
, `title`								varchar(512)	NOT NULL
, `description`							varchar(2048)
, `life_cycl_id`						tinyint(4)		NOT NULL
, `insrt_tmst`							datetime		NOT NULL
, `expct_hours`							decimal(3,2)	NOT NULL
, `last_open_time`						decimal(5,2)	NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`tid`)
, CONSTRAINT `StTktLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StTktOpnrToPrsnFrgnKey`			FOREIGN KEY (`opener`)			REFERENCES `StPrsnInst` (`pid`)
, CONSTRAINT `StTktAsgnToPrsnFrgnKey`			FOREIGN KEY (`assignee`)		REFERENCES `StPrsnInst` (`pid`)
, CONSTRAINT `StTktToPriMtxFrgnKey`				FOREIGN KEY (`aff_level`,`severity`) 
																				REFERENCES `StPriMtxConf` (`aff_level`,`severity`)
, CONSTRAINT `StTktLfeCyclToLfeCyclFrgnKey`		FOREIGN KEY (`life_cycl_id`)	REFERENCES `StLfeCyclConf` (`life_cycl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tickets for tasks';

-- --------------------------------------------------------

-- Ticket comment instance

CREATE TABLE IF NOT EXISTS `StTktCmntInst` (
  `tid`									bigint(20)		NOT NULL
, `commenter`							bigint(20)
, `text`								varchar(2048)	NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, CONSTRAINT `StTktCmntLastMdfdToPrsnFrgnKey`	FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StTktCmntToTktFrgnKey`			FOREIGN KEY (`tid`)				REFERENCES `StTktInst` (`tid`)
, CONSTRAINT `StTktCmntToCmntrFrgnKey`			FOREIGN KEY (`commenter`)		REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Comments on tickets';

-- --------------------------------------------------------

-- Equipment instance

CREATE TABLE IF NOT EXISTS `StEqpInst` (
  `eid`									bigint(20)		NOT NULL										AUTO_INCREMENT
, `name`								varchar(64)		NOT NULL
, `vendor`								varchar(64)
, `model`								varchar(64)
, `serial`								varchar(64)
, `type`								varchar(32)
, `loc`									varchar(64)
, `status`								varchar(4)
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`eid`)
, CONSTRAINT `StEqpLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
, CONSTRAINT `StEqpStsEnum`						CHECK ( `status` in ('BRKN','CHOT','CHIN') )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Equipment owned by PKI';

-- --------------------------------------------------------

-- Software instance

CREATE TABLE IF NOT EXISTS `StSftInst` (
  `sid`									bigint(20)		NOT NULL
, `name`								varchar(64)		NOT NULL
, `logl_del`							tinyint(1)		NOT NULL		DEFAULT '0'
, `last_mdfd_user`						bigint(20)						DEFAULT NULL
, `last_mdfd_tmst`						datetime		NOT NULL		DEFAULT CURRENT_TIMESTAMP		ON UPDATE CURRENT_TIMESTAMP
, PRIMARY KEY (`sid`)
, CONSTRAINT `StSftLastMdfdToPrsnFrgnKey`		FOREIGN KEY (`last_mdfd_user`)	REFERENCES `StPrsnInst` (`pid`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Software owned by PKI';

-- --------------------------------------------------------

-- Software-Equipment

CREATE TABLE IF NOT EXISTS `StSftToEqpInst` (
  `sid`									bigint(20)		NOT NULL
, `eid`									bigint(20)		NOT NULL
, CONSTRAINT `StSftEqpToSftFrgnKey`				FOREIGN KEY (`sid`)				REFERENCES `StSftInst` (`sid`) ON DELETE CASCADE
, CONSTRAINT `StSftEqpToEqpFrgnKey`				FOREIGN KEY (`eid`)				REFERENCES `StEqpInst` (`eid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Software installed on equipment';