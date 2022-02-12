import axios from "axios";

const ajax = axios.create();

ajax.interceptors.response.use(axios.defaults, (error) => {
  const { message, response } = error;
  if (error.code === "ECONNABORTED") {
    const eTimeout = new Error(
      "Request take longer than expected. Aborting process"
    );
    return Promise.reject(eTimeout);
  }

  if (axios.isCancel(error)) {
    return Promise.reject(new Error("Request is cancelled"));
  }

  let err = message;
  if (response) {
    if (response.data.errors) {
      err = response.data.errors;
      return Promise.reject(err);
    }
    if (response.data.message) {
      err = response.data.message;
    }
  }

  return Promise.reject(err);
});

export { ajax };
