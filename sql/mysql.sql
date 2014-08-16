
CREATE TABLE demoxadr_todo (
	todo_id          int(10)      NOT NULL  auto_increment,
	todo_uid         int (10)     NOT NULL default '0',
	todo_subject     varchar(255) NOT NULL default '',
	todo_description text         NOT NULL ,
	todo_input_date  int(10)      NOT NULL default '0',
	todo_total_time  int(10)      NOT NULL default '0',
	todo_active      tinyint(1)   NOT NULL default '0',
	todo_lock_id     int(10)      NOT NULL default '0',
	PRIMARY KEY (todo_id)
) ENGINE=MyISAM;

CREATE TABLE demoxadr_log (
	log_id           int(10)      NOT NULL  auto_increment,
	log_todo_id      int(10)      NOT NULL default '0',
	log_start_time   int(10)      NOT NULL default '0',
	log_end_time     int(10)      NOT NULL default '0',
	log_work_time    int(10)      NOT NULL default '0',
	PRIMARY KEY (log_id)
) ENGINE=MyISAM;
