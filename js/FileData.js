class FileData {
  #value;

  constructor() { }

  get exists() {
    return this.#value;
  }

  send_data(file_dir, data) {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", file_dir, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        return true;
      }
    };

    xhr.send(JSON.stringify(data));
  }
  // here is private function
   getData(file_dir, callback) {
      const xhr = new XMLHttpRequest();
  
      xhr.open('GET', file_dir, true);
  
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) { // Check for successful response
            const data = JSON.parse(xhr.responseText);
            callback(data);
          } else {
            console.error('Error retrieving data:', xhr.statusText);
          }
        }
      };
  
      xhr.send();
  }
  

  
 
}



export default  FileData;