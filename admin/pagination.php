<?php
function pagination($rows_per_page = 5, $sql){
if(isset($_GET["page"])){
$page = $_GET["page"];
} else{
$page = 1;
}
$per_row = $page * $rows_per_page - $rows_per_page;
$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product"));
$total_pages = ceil($total_rows/$rows_per_page); //hàm làm tròn lên
$sql .= "LIMIT $per_row, $rows_per_page";
$query = mysqli_query($conn, $sql);
return $query;
}


function list_page($ul = '<ul class="pagination">', $pre_li = '<li class="page-item"><a class="page-link"'){
$list_pages = $ul;
    //Page Previous
    $page_prev = $page - 1;
    if($page_prev == 0){
    $page_prev = 1;
    }
    $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_prev.'">&laquo;</a></li>';
    //End Page Previous
    for($i = 1; $i <= $total_pages; $i++){ 
        $list_pages .='<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' .$i.'">'.$i.'</a></li>';
    }
        //Page Next
        $page_next = $page + 1;
        if($page_next > $total_pages){
        $page_next = $total_pages;
        }
        $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">&raquo;</a></li>';
        //End Page Next
        $list_pages .= '</ul>';
        return $list_pages;
}
?>