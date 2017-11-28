<?php
class Migration_Create_modules extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'con
				straint' => '255',
			),
			'module_type' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'module_layout' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
			),
			'position' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE,
			),
			'set_order' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE, 
			),
			'privilege_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0,
			),
			'limit_articles_number' =>array(
				'type' => 'INT' ,
				'constraint' => 11,
				'null' => TRUE,
			),			
			'limit_projects_number' =>array(
				'type' => 'INT' ,
				'constraint' => 11,
				'null' => TRUE,
			),
			'created' => array(
				'type' => 'DATETIME',
			),
			'created_by' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0,
			),
			'modified' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'modified_by' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,
			),
			'show_title' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1
			),
			'is_published' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1
			),
			'deleted' => array(
					'type' => 'TINYINT',
					'constraint' => 1,
					'default' => 0,
			),


		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('modules');
	}

	public function down()
	{
		$this->dbforge->drop_table('modules');
	}
}