<?php
class Migration_Create_page_portfolio_content extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'page_id' =>array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'portfolio_categories' =>array(
				'type' => 'VARCHAR' ,
				'constraint' => 255,
			),


		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('page_portfolio_content');
	}

	public function down()
	{
		$this->dbforge->drop_table('page_portfolio_content');
	}
}