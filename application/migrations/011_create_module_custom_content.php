<?php
class Migration_Create_module_custom_content extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'module_id' =>array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'body' => array(
				'type' => 'TEXT',
			),


		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('module_custom_content');
	}

	public function down()
	{
		$this->dbforge->drop_table('module_custom_content');
	}
}