
const HTTP = Object.freeze({
  OK:200,
  SERVER_ERROR:500,
  NOT_FOUND:404,
  BAD_REQUEST:400
});

const Methods = Object.freeze({
  GET: "GET",
  POST: "POST",
  PUT: "PUT",
  DELETE: "DELETE",
  PATCH: "PATCH"
});

function fetchData(url, method= "GET", formData = null) {
  return fetch(`../server/${url}`, {
      method,
      headers: {
        "Content-Type": "application/json"
      },
      body : formData
  }).then((resp) => resp.json())
  .then((data) => data)
  .catch(err => console.error(err));
}

export { HTTP, fetchData, Methods}