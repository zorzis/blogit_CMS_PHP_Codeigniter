<?php
class Migration_Create_pages extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'page_type' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'is_home' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'created' => array(
				'type' => 'DATETIME',
			),
			'created_by' => array(
				'type' => 'INT',
				'constraint' => 11,
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
			'main_menu' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'privilege_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0,
			)	
			'modules' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
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
			'meta_keywords' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'meta_description' => array(
				'type' => 'TEXT',
			),
			'seo_page_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('pages');
	}

	public function down()
	{
		$this->dbforge->drop_table('pages');
	}
}