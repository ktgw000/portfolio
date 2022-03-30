
function object2query(obj) {
  let q = '';
  for(const prop in obj) {
    if(q.length > 0) q += '&';
    q += prop + '=' + obj[prop];
  }
  return q;
}

async function fetchJSON(requestURL, getQuery = {}, postQuery = {}, $isFileMode = false) {
  const useGet = Object.keys(getQuery).length, usePost = Object.keys(postQuery).length;

// リクエストデータ
  const data = {
    method: usePost ? 'POST' : 'GET',
    headers: {'Content-Type': $isFileMode ? 'multipart/form-data' : usePost ? 'application/x-www-form-urlencoded' : 'text/plain'},
    mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    redirect: 'follow',
    referrerPolicy: 'no-referrer'
  };
  if(usePost) data.body = object2query(postQuery);

  const response = await fetch(requestURL + (useGet ? '?' + object2query(getQuery) : ''), data);
  return response.json();
}

window.onload = () => {
	const okinibtns = document.getElementsByClassName('okinibutton');
	for(const okinibtn of okinibtns) {
		fetchJSON('/wordpress/wp-content/themes/sample/test.php', {
			okini_post_id: okinibtn.dataset.id,
			okini_sku: okinibtn.dataset.sku
		}).then(r => {
			if(r.result) okinibtn.classList.add('okinied');
		});
	}
};

// お気に入り済みの場合
const favoriteAdd = document.getElementById("favoriteAdd");
const favoriteAddInput = favoriteAdd.getElementsByTagName("input")[0];
favoriteAdd.addEventListener("click",() => {
  if(favoriteAddInput.value = "お気に入りに追加"){
    favoriteAddInput.value = "お気に入り済み"
    favoriteAdd.classList.add("transform");
  }
  else if(favoriteAddInput.value = "お気に入り済み"){ //こっち動かない
    favoriteAddInput.value = "お気に入りに追加"
    favoriteAdd.classList.remove("transform");
  }
})

