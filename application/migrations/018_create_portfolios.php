<?php
class Migration_Create_portfolios extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'project_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'project_slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'project_description' => array(
				'type' => 'TEXT',
			),
			'client_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'client_description' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'client_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'project_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'company_proposal' => array(
				'type' => 'TEXT',
			),
			'developer' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'date_project_done' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
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
			'project_category_id' => array(
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
		$this->dbforge->create_table('portfolio_projects');
	}

	public function down()
	{
		$this->dbforge->drop_table('portfolio_projects');
	}
}