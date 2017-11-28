<?php
class Migration_Create_menus extends CI_Migration {

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
			'privilege_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0,
			),
			'priority_order' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE, 
			),
			'show_title' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 1
			),
			'is_global' => array(
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
		$this->dbforge->create_table('menus');

		$data = array(
			array(
				'id' 		=> "1",
				'title'		=>	"Main Menu",
				'is_global'	=>	"1",
				'created'	=>	date('Y-m-d H:i:s'),
			), 
		);

		$this->db->insert_batch('menus', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('menus');
	}
}