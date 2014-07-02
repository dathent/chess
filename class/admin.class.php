<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/chess/class/autoload_chessman_class.php');

class Admin{
	
	private $datalist_user = "			
				<datalist id='status_user'>
					<option>activate</option>
					<option>inactivate</option>
					<option>blocked</option>
					<option>delete</option>
				</datalist>
				<datalist id='role_user'>
					<option>user</option>
					<option>admin</option>
				</datalist>";
	
    function render($tablename, $set = 0, $where = 0, $oper = ' or '){
        $dbclass = Database::dbase();
        return $dbclass->search_db($tablename, $set, $where, $oper);
    }

   function output_user_list(){
       $users = $this->render('user',array('id','login'));
       $list_user = null;
       foreach($users as $value){
           $list_user .= "<option value='".$value['id']."'>
				 ".$value['login']."
		   </option>";
		}
       return $list_user;
	}
   
	function edit_form($table, $set, $id){
		$select = $this->render($table,$set, array('id' =>$id));
		$form = null;
		foreach($select as $value){
			$form .= "<form method='POST' action='".URL."admin/?all_$table' ><table class='admin_table'>";
			$th = null;
			if($th == null){
				foreach($value as $key=>$data){
					if($key == 'id') continue;
					$th .= "<th> $key </th>";
				}
				if($table == 'user') 
					$th .= "<th>New password</th>";
				$form .= "<tr>".$th."</tr>";
			}
			$form .= "<tr>";
			foreach($value as $key => $context){
					if($key == 'id'){
						$id = $context;
						continue;
					}
					if($key == 'status' or $key == 'role'){
						$form .= "<td><input list='".$key."_$table' name='$key' value='$context' class='input_form_admin_option'></td>";
					}
					else
						$form .= "<td><input type='text' name='$key' value='$context' class='input_form_admin'></td>";
			}
			if($table == 'user') 
				$form .= "<td><input type='password' name='password' class='input_form_admin'></td>";
			
			$form .="</tr>
					</table>
				<input type='hidden' value='".$id."' name='id'>
				<input type='submit' name='edit_$table' value='Save'>";
			if($table == 'user')
				$form .= $this->datalist_user;
				
			$form .= "</form>";
		}
		return $form;
	}
	
	function confirm_form($id, $confirm){
		$form = "<form action='".URL."admin/?all_user' method='POST'>";
		$option = null;
		foreach($id as $value){
			$option .= "<option value='$value' selected></option>";
		}
		$form .= $this->browse('user',array('login', 'email', 'real_name',  'created', 'edited', 'status','role' ),$id);
		$form .= "<select hidden multiple name='id[]'>".$option."</select>
				<h2>You want to $confirm this user ? </h2>
				<input type='hidden' name='status' value='$confirm'>
				<input type='submit' name='".$confirm."_user' value='$confirm'>";
		return $form;
	}
	
   
   function browse($table, $set=0, $id = 0 ){
        $id = ($id != 0)? array('id'=>$id): 0;
		$select = $this->render($table,$set,$id);
		$table  = "<table class='admin_table'>";
		$th = null;
		foreach($select as $value){
			if($th == null){
				foreach($value as $key=>$data){
					$th .= "<th> $key </th>";
				}
				$table .= "<tr>".$th."</tr>";
			}
			$table .= "<tr>";
				foreach($value as $context){
					$table .= "<td>$context</td>";
				}
			$table .= "</tr>";
		}
		$table  .= "</table>";
		return $table;
	}   
}