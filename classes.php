<?php

class Blogger
{

// private $connnect; private $servername ,

	function __construct($conn){
		$this->conn=$conn;
	}
	public function is_login($email,$password)
	{
		
		$query1="SELECT blogger_username,blogger_password from blogger_info where blogger_username='$email' and blogger_password='$password'";
		$result=$this->conn->query($query1);
		if($result->num_rows > 0)
		{
			echo "in login method";
			return true;
		}
		else
		{
			return false;
		}
	}
	public function blogger_logout()
	{
	 	unset($_SESSION['username']);
	 	session_destroy();
	 	echo "<script type='text/javascript'>alert('Succesfully Logout');window.location.href = 'index.php';</script>";
	 	
	 }
	public function is_signup($firstname,$email,$password){

		$date=date("Y-m-d");
		

		$query2="SELECT blogger_username from blogger_info where blogger_username='$email'";
		$result2= $this->conn->query($query2);
		if($result2->num_rows === 0)
		{
			$query1="INSERT INTO blogger_info(blogger_username,blogger_password,blogger_firstname,blogger_creation_date,blogger_is_active) VALUES('$email','$password','$firstname','$date',0)";
		if($this->conn->query($query1))
		{
			return true;
		}
		else
		{
			return "Sorry something went wrong";
		}	
	}
	else{
		return "Username already exists";
		}
	}
	public function is_permitted($username){
		$query1="SELECT blogger_is_active from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row=$result1->fetch_assoc();
			return $row["blogger_is_active"];
		}
		else{
			return false;
		}
	}


	public function get_blogger_id($username)
	{
		$query1="SELECT blogger_id from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row1 = $result1->fetch_assoc();
			$id = (int)$row1["blogger_id"];
			return $id;
		}
		else{
			return false;
		}
	}


	public function publish($username,$title,$category,$desc,$path)
	{
		$id = $this->get_blogger_id($username);
		if ($id == false)
		{
			return "No blogger id found";
		}

		$date=date("Y-m-d");
		$query2= "INSERT INTO blog_master(blogger_id,blog_title,blog_desc,blog_category,blog_author,blog_is_active,creation_Date) VALUES($id,'$title','$desc','$category','$username',1,'$date')";
		$result= $this->conn->query($query2);
		$image = $this->add_image($path);
		if($result && $image)
		{
			return true;
		}
		else{
			return false;
		}
	}
	public function get_last_blog_id()
	{
		$query1="SELECT blog_id FROM blog_master ORDER BY blog_id DESC LIMIT 1";
		$result=$this->conn->query($query1);
		if($result)
		{
			$row = $result->fetch_assoc();
			$id = (int)$row["blog_id"];
			return $id;
		}
		else{
			return false;
		}
	}
	public function add_image($path)
	{
		$blog_id = $this->get_last_blog_id();
		if($blog_id != false){
			$query1 = "INSERT INTO blog_detail(blog_id,blog_detail_image) VALUES('$blog_id','$path')";
			if($this->conn->query($query1))
			{
				return true;
			}
			else{
				return false;
			}
		}
	}	

	public function get_blog($username)
	{
		$id = $this->get_blogger_id($username);
		if ($id == false)
		{
			return "No blogger id found";
		}
		$query1 = "SELECT blog_id,blog_title,blog_desc,blog_category,creation_date,updated_date from blog_master where blogger_id='$id'";
		$result= $this->conn->query($query1);
		if($result){
			$i=0;
			$blogs = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 5 for 5 fields id,title,desc,category,date, 
				while ($j < 6){ 
				$blogs[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $blogs;

		}
		else{
			return false;
		}

	}
	public function get_blog_update($blog_id)
	{
		$query1= "SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author from blog_master where blog_id='$blog_id'";
		$result = $this->conn->query($query1);
		if($result)
		{
			$row = $result->fetch_assoc();
			return $row;
		}
		else{
			return false;
		}
	}
	public function update($blog_id,$title,$category,$desc,$path)
	{
		$date=date("Y-m-d");
		$query1 = "UPDATE blog_master SET blog_title='$title',blog_category='$category',blog_desc='$desc',updated_date = '$date' WHERE blog_id='$blog_id'";
		$update =$this->conn->query($query1);
		$image = $this->update_image($path,$blog_id);
		if($update && $image)
		{
			return true;
		}
		else{
			return false;
		}

	}
	public function update_image($path,$blog_id)
	{
		$query1 = "UPDATE blog_detail SET blog_detail_image='$path' WHERE blog_id = '$blog_id'";
		if($this->conn->query($query1))
		{
			return true;
		}
		else{
			return false;
		}

	}
}



class Admin{
	function __construct($conn){
		$this->conn=$conn;
	}
	public function is_login($username,$password){
			if($username === "admin" && $password === "mansi")
			{
				return true;
			}
			else{
				return false;
			}
	}


	public function get_bloggers(){
		$query1="SELECT blogger_firstname,blogger_username,blogger_is_active,blogger_id from blogger_info";
		$result=$this->conn->query($query1);
		if($result)
		{
			// $bloggers = $this->conn->fetch_all($result,MYSQL_ASSOC);
			// return $bloggers;
			$i=0;
			$bloggers = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 3 for 3 fields username,firstname,is_active 
				while ($j < 4){ 
				$bloggers[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $bloggers;

		}
		else
		{
			return false;
		}

	}
        
        public function get_contacts(){
		$query1="SELECT name,email,message from contactlist";
		$result=$this->conn->query($query1);
		if($result)
		{
			// $bloggers = $this->conn->fetch_all($result,MYSQL_ASSOC);
			// return $bloggers;
			$i=0;
			$bloggers = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 3 for 3 fields username,firstname,is_active 
				while ($j < 3){ 
				$bloggers[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $bloggers;

		}
		else
		{
			return false;
		}

	}
        
        public function get_posts($blogger_id){
		$query1="SELECT blog_id,blogger_id,blog_title,creation_date from blog_master where blogger_id='$blogger_id'";
		$result=$this->conn->query($query1);
		if($result)
		{
			// $bloggers = $this->conn->fetch_all($result,MYSQL_ASSOC);
			// return $bloggers;
			$i=0;
			$bloggers = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 3 for 3 fields username,firstname,is_active 
				while ($j < 4){ 
				$bloggers[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $bloggers;

		}
		else
		{
			return false;
		}

	}
	public function get_documents(){
		$query1="SELECT document_id,document_name from document ORDER BY creation_date DESC";
		$result=$this->conn->query($query1);
		if($result)
		{
				$documents=array();
				$i=0;
				while ($row = $result->fetch_array(MYSQLI_NUM)) {
					$j=0;
					while($j < 2){
						$documents[$i][$j] = $row[$j];
						$j=$j+1;
				}
						$i=$i+1;

				}
				return $documents;

		}
		else{
			return false;
		}

	}
        public function delete_post($blogger_id,$blog_id) {
            $query1 = "DELETE FROM blog_detail WHERE blog_id='$blog_id'";
            $query = "DELETE FROM blog_master WHERE blog_id='$blog_id'";
            $result1 = $this->conn->query($query1);
            
            if ($result1){
                $result = $this->conn->query($query);
                if ($result){
                    return true;
                }
                else {
                    return false;
                }
            }
            else{
                return false;
            }
            
        }
	public function delete_document($fileId)
	{
		
		$query1="SELECT document_name from document WHERE document_id='$fileId'";
		$result=$this->conn->query($query1);
		if($result)
		{
			$row=$result->fetch_assoc();

			$fileName="documents/".$row["document_name"];
		}
		$isDeleted=unlink($fileName);
		if($isDeleted)
		{
			$query2="DELETE from document WHERE document_id='$fileId'";
			$result2=$this->conn->query($query2);
			if($result2)
			{
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}

	}	

	public function permission($username,$active){
		$query1 = "SELECT blogger_is_active from blogger_info where blogger_username='$username'";
		$result = $this->conn->query($query1);
		if($result){
			$query2= "UPDATE blogger_info SET blogger_is_active='$active' where blogger_username='$username'";
			if($result2=$this->conn->query($query2))
			{
				return true;
			}
			else{
				return false;
			}

		}
		else{
				return "Something went wrong";
			}	
	}
	public function admin_logout()
	{
	 	unset($_SESSION['admin']);
	 	session_destroy();
	 	header('Location:index.php');
	 	
	 }
	 public function add_document($document_name){
	 	$date=date("Y-m-d");
	 	$query1="INSERT INTO document(document_name,creation_date) VALUES('$document_name','$date')";
	 	if($this->conn->query($query1))
			{
				return true;
			}
			else{
				return false;
			}

	 }
}
class Viewer{
	function __construct($conn){
		$this->conn=$conn;
	}
	public function get_all_blogs($word_limit,$blog_id)//id for getting whole blog
	{
		if($blog_id === 'all'){
		$query1 ="SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author,creation_date,updated_date from blog_master order by blog_id desc";
		}
		else{
			$query1 = "SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author,creation_date,updated_date from blog_master WHERE blog_id = '$blog_id' order by blog_id"; 
		}
		$result1= $this->conn->query($query1);

		if($result1)
		{
			$i=0;
			$blogs = array();
			while ($row = $result1->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 6 for 6 fields  
				while ($j < 8){ 
					if($j == 3 && $word_limit != '' && $blog_id != '*')
					{
						$blogs[$i][$j]= $this->limit_words($row[$j],$word_limit); 
					}
					else{
						$blogs[$i][$j]=$row[$j];
					}
				if($j == 1)//for blogger id 
				{
					$query2="SELECT blogger_firstname,blogger_username from blogger_info where blogger_id ='$row[1]'";
					$result2 = $this->conn->query($query2);
					if($result2)
					{
						$row2=$result2->fetch_assoc();
						$blogs[$i][9]=$row2['blogger_username'];
						$blogs[$i][8]=$row2['blogger_firstname'];
					}
				}
				$j=$j+1;
				}

				$i=$i+1;
			}
			return $blogs;
		}
		else
		{
			return false;
		}
	}

	public function get_blogger($username)
	{
		$query1="SELECT blogger_firstname from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row1 = $result1->fetch_assoc();
			$firstname = $row1["blogger_firstname"];
			return $firstname;
		}
		else{
			return false;
		}
	}
        public function contact_us($name,$email,$msg) {
            if (empty($msg)) {
            $query = "INSERT INTO contactlist(name,email) VALUES ('$name','$email')";
            }else {
            $query = "INSERT INTO contactlist(name,email,message) VALUES ('$name','$email','$msg')";
            }
           if ($this->conn->query($query)) {
            return true;
           } else {
            return false;
        }
    }
       
    public function increaseLikes($blog_id,$likes) {
        $like = $likes+1;
        $query = $this->conn->query("UPDATE blog_master SET likes = '$like' where blog_id='$blog_id'");
        if ($query){
            return true;
        }
        else{
            return false;
        }
    }

    public function profile($username)
	{
		$profile = new Blogger($this->conn);
		$blogs =$profile->get_blog($username);
		if($blogs != false)
		{
			return $blogs;
		}
		else{
			return false;
		}

	}
	public function limit_words($string,$word_limit)
	{
		$words = explode(" ", $string);
		return implode(" ", array_slice($words,0,$word_limit+1));
	}
	public function get_blog_image($blog_id)
	{
		$query1 = "SELECT blog_detail_image FROM blog_detail WHERE blog_id='$blog_id'";
		$result1 = $this->conn->query($query1);
		if($result1)
		{
			$row = $result1->fetch_assoc();
			return $row["blog_detail_image"];
		}
		else{
			return false;
		}
	}
	public function get_blogs_by_category($category)
	{
		$query1 = "SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author,creation_date,updated_date from blog_master WHERE blog_category LIKE '%$category%' order by blog_id desc";
		$result1= $this->conn->query($query1);
		if($result1)
		{
			$i=0;
			$blogs = array();
			while ($row = $result1->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 6 for 6 fields  
				while ($j < 8){ 
					
						$blogs[$i][$j]=$row[$j];
					
				if($j == 1)//for blogger id 
				{
					$query2="SELECT blogger_firstname,blogger_username from blogger_info where blogger_id ='$row[1]'";
					$result2 = $this->conn->query($query2);
					if($result2)
					{
						$row2=$result2->fetch_assoc();
						$blogs[$i][9]=$row2['blogger_username'];
						$blogs[$i][8]=$row2['blogger_firstname'];
					}
				}
				$j=$j+1;
				}

				$i=$i+1;
			}
			return $blogs;
		}
		else
		{
			return false;
		}
	}
	public function searchBlogs($string)
	{

		$query1="SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category from blog_master WHERE ((blog_category LIKE '%$string%') OR (blog_title LIKE '%$string%')) ORDER BY creation_date DESC";
		$result1=$this->conn->query($query1);
		$query2="SELECT blogger_firstname,blogger_id,blogger_username from blogger_info WHERE ((blogger_firstname LIKE '%$string%') OR (blogger_username LIKE '%$string%'))";
		$result2=$this->conn->query($query2);
		$query3="SELECT document_name from document WHERE ((document_name LIKE '%$string%')) ORDER BY creation_date DESC";
		$result3=$this->conn->query($query3);
		$output = array();
		$output1=array();
		$output2 = array();
		$output3=array();
		if($result1){
			$output1=$result1->fetch_all(MYSQLI_ASSOC);
			$output2=$result2->fetch_all(MYSQLI_ASSOC);
			$output3=$result3->fetch_all(MYSQLI_ASSOC);
			$output=array_merge($output1,$output2,$output3);

			$output=json_encode($output);
			return $output;
		}
	}
}

?>