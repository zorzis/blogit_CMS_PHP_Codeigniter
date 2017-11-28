<?php
class Migration_Create_portfolio_categories extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'portfolio_category_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'portfolio_category_slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'portfolio_category_description' => array(
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

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('portfolio_categories');

		$data = array(
			array('id' => "1",
			'portfolio_category_title'		=>	"Uncategorized",
			'portfolio_category_slug'			=>	"uncategorized",
			'portfolio_category_description'	=>	"Default Category",
			'created'				=>	date('Y-m-d H:i:s'),
			) 
		);

		$this->db->insert_batch('portfolio_categories', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('portfolio_categories');
	}
}