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
  fetchJSON('/wordpress/<?php echo get_template_directory_uri(); ?>/test.php', {
    okini_all: 1
  }).then(r => {
    for(let i = 0; i < r.result.length; i++){
      const postId = r.result[i].post_id;
      console.log(postId);
    }
    console.log(r.result)
  })
}


let xhr = new XMLHttpRequest();
xhr.open("POST", "/wordpress/<?php echo get_template_directory_uri(); ?>/favoriteList.php");
xhr.responseType = "json"; 
xhr.addEventListener("load", () => {
  console.log(xhr.response);
});
let date = new FormData();
date.append("number","100");
xhr.send(date);

