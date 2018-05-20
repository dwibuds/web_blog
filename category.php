<?php
include'template/overall/header.php';

$id = abs((int)$_GET['id']);
$get_cat = mysqli_fetch_assoc(mysql_query($koneksi, "SELECT * FROM tw_category WHERE cat_id='$id'"));

$dataPerPage = 5;	

if(isset($_GET['page'])){
	$noPage = $_GET['page'];
}else{
	$noPage = 1;
}

$offset = ($noPage - 1) * $dataPerPage;

echo '<div class="content-title">.:: Kategori &raquo; '.$get_cat['cat_name'].' ::.</div>';
echo '<div class="content-body">';
$sql = mysqli_query($koneksi, "SELECT * FROM tw_blog WHERE blog_cat_id='$id' ORDER BY blog_id DESC LIMIT $offset, $dataPerPage");
if(mysqli_num_rows($sql) == 0){
	echo 'Blank...!';
}else{
	while($data = mysqli_fetch_assoc($sql)){
		$cat_id = $data['blog_cat_id'];
		$cat = mysqli_query($koneksi, "SELECT * FROM tw_category WHERE cat_id='$cat_id'");
		$data_cat = mysqli_fetch_assoc($cat);
		
		echo '<div id="blog">';
		echo '<div class="blog-title">'.$data['blog_title'].'</div>';
		echo '<div class="blog-desc">'.substr($data['blog_body'],0,350).' [...]</div>';
		echo '<div class="blog-info">';
		echo $data['blog_user'].' | '.$data['blog_date'].' | '.$data_cat['cat_name'];
		echo '<a class="more" href="single.php?id='.$data['blog_id'].'">Readmore &raquo;</a>';
		echo '</div>';
		echo '</div>';
	}
	
	$query = "SELECT COUNT(blog_id) AS jumData FROM tw_blog WHERE blog_cat_id='$id'";
	$hasil = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_array($hasil);
	
	$jumData = $row['jumData'];
	
	$jumPage = ceil($jumData/$dataPerPage);
	
	echo '<div class="paging">';
	if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?id=".$id."&page=".($noPage-1)."'>&laquo; Prev</a>";
	
	for($page = 1; $page <= $jumPage; $page++){
		if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){   
			if (($showPage == 1) && ($page != 2))  echo "..."; 
			if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
			if ($page == $noPage) echo " <b>".$page."</b> ";
			else echo " <a href='".$_SERVER['PHP_SELF']."?id=".$id."&page=".$page."'>".$page."</a> ";
			$showPage = $page;          
		 }
	}
	
	if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?id=".$id."&page=".($noPage+1)."'>Next &raquo;</a>";
	echo '</div>';
}
echo '</div>';

include'template/overall/footer.php';
?>