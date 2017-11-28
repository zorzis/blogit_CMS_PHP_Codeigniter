<?php
class Migration_Create_articles extends CI_Migration {

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
				'constraint' => '255',
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'pubdate' => array(
				'type' => 'DATE',
			),
			'body' => array(
				'type' => 'TEXT',
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
			'author_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,
			),
			'category_id' => array(
				'type' => 'INT',
				'constraint' => 11,
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
			'tags' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'views_counter' => array(
				'type' => 'INT',
				'constraint' => 22,
				'default' => 0,
			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('articles');
	}

	public function down()
	{
		$this->dbforge->drop_table('articles');
	}
}