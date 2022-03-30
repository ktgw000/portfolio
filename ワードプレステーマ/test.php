<?php #お気に入り非同期処理API

session_start();

$isInit = !empty($_GET['okini_post_id']) && !empty($_GET['okini_sku']);
$isBtn = !empty($_POST['okini_post_id']) && !empty($_POST['okini_sku']);
$isAll = !empty($_GET['okini_all']);#1でも送るとしましょう

#アクセス方法がおかしい場合は何もせず終了
if(!$isInit && !$isBtn && !$isAll) {
	echo '{"result":"パラメーター不正"}';
	exit;
}

if($isInit){
	$id = $_GET['okini_post_id'];
	$sku = $_GET['okini_sku'];
	$exist = empty($_SESSION['okini'][$id][$sku]) ? 0 : 1;
	echo '{"result":' . $exist . '}';#現在の状態を送る 0:OFF 1:ON
	exit;
}

if($isBtn){
	$id = $_POST['okini_post_id'];
	$sku = $_POST['okini_sku'];

#1:今はOFF 0:今はON(ボタンを押した場合切り替わる)
	$exist = empty($_SESSION['okini'][$id][$sku]) ? 1 : 0;

#なければお気に入り一覧に追加、あれば消す
	if($exist) $_SESSION['okini'][$id][$sku] = '1'; 
	else unset($_SESSION['okini'][$id][$sku]);
	echo '{"result":' . $exist . '}';
}

if($isAll){
	if(empty($_SESSION['okini'])){
		echo '{"result":[]}';
		exit;
	}
	$list = ['result' => []];
	foreach($_SESSION['okini'] as $post_id => $skus){
		foreach($skus as $sku => $val){
			$list['result'][] = [
				'post_id' => $post_id,
				'sku' => $sku
			];
		}
	}
	echo json_encode($list);
}
?>
