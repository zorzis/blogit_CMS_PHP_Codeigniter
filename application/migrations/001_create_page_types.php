<?php
class Migration_Create_page_types extends CI_Migration {

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
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'is_published' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('page_types');

		$data = array(
			array(
				'id' 			=> 	"1",
				'title'			=>	"Custom Page",
				'description'	=>	"Shows custom page content.",
			), 
			array(
				'id' 			=> 	"2",
				'title'			=>	"Blog",
				'description'	=>	"Shows custom blog article, category articles and more",
			), 
			array(
				'id' 			=> 	"3",
				'title'			=>	"Custom Url",
				'description'	=>	"Redirects to a custom url",
			), 
		);

		$this->db->insert_batch('page_types', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('page_types');
	}
}