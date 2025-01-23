function removeQueryParam(param){
    const url = new URL(window.location);
    url.searchParams.delete(param);
    window.history.replaceState({}, document.title, url);
}

removeQueryParam('message');

console.log('returnScript.js loaded');