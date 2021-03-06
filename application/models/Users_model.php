<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public $table = 'users';
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    /**
     * Update a user, password will be hashed
     *
     * @param int id
     * @param array user
     * @return int id
     */
    public function update($id, $user)
    {
        // prevent overwriting with a blank password
        if (isset($user['password']) && $user['password']) {
            $user['password'] = $this->hash($user['password']);
        } else {
            unset($user['password']);
        }

        $this->db->where('id', $id)->update($this->table, $user);
        return $id;
    }

    /**
     * Retrieve a user
     *
     * @param string where
     * @param int value
     * @param string identification field
     */
    public function get($where, $value = FALSE)
    {
        if (!$value) {
            $value = $where;
            $where = 'id';
        }

        $user = $this->db->where($where, $value)->get($this->table)->row_array();
        return $user;
    }

    public function exists($where, $value = FALSE)
    {
        return $this->db->where($where, $value)->count_all_results($this->table);
    }

    public function record_count($tableName,$condition)
        {
            SetCondition($condition,false);
            if($tableName!='' || !empty( $tableName )){
                $this->table = $tableName;
            }
            return $this->db->count_all_results( $this->table );
        }

        public function get_records( $tableName, $start, $limit, $condition = array())
        {
            SetCondition($condition);
            if($tableName!='' || !empty( $tableName )){
               $this->table = $tableName;
            }
            $this->db->limit($limit, $start);
            $query = $this->db->get($this->table);
           // echo $this->db->last_query();exit;
            return ( $query->num_rows() > 0 ) ? $query->result_array() : false;
        }
		
		 public function get_users_device_tokens($val=""){            
            if($val==''){
                $query = $this->db->select('device_token')->where('device_token IS NOT NULL')->get('users');                
                return $query->result();
            }
            if($val=='ios'){				
                $query = $this->db->select('device_token')->where('device_type','ios')->where('device_token IS NOT NULL')->get('users');
                return $query->result();
            }
            
            if($val=='android'){				
                $query = $this->db->select('device_token')->where('device_type','android')->where('device_token IS NOT NULL')->get('users');
                return $query->result();
            }else{
				$query = $this->db->select('device_token')->where_in('id',$val)->where('device_token IS NOT NULL')->get('users');				
                return $query->result();
				
			}         
            
        }
		
		 public function user_search($keyword){			
            $this->db->select()
					->from('users')					
					->where("fullname LIKE '%$keyword%' OR email LIKE '%$keyword%' ")
					->where('device_token IS NOT NULL');					
            $sql = $this->db->get(); 
            //echo $this->db->last_query();die;          
            $result = $sql->result_array();
            return $result;
        }



}
