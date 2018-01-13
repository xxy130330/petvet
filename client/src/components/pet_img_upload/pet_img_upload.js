import React, { Component } from "react";
import "../add_pet/add_pet.css";
import "./pet_img_upload.css";
import photo from "../../../../server/images/photo.png";
import axios from "axios";

class PetImgUpload extends Component {
  constructor(props) {
    super(props);

    this.getFileName = this.getFileName.bind(this);
  }
  getFileName(e) {
    var fileName = e.target.files[0];

      //axios call for page.php
      //GET request user file name
      //return URL to store in db



      axios.post('/server/database_connect/server.php?action=post&resource=upload-item',{
        upload: fileName.name,
      })
          .then(function (response) {
              console.log(response);
          })
          .catch(function (error) {
              console.log(error);
          });



    console.log('FILENAME: ', fileName.name);
  }
  render() {
    return (
      <div className="img_container" id="hide">
        <label
          action="upload_test.php"
          encType="multipart/form-data"
          method="post"
          className="img_label"
        >
          <div className="picture">
            <img src={photo} />
          </div>
          <input type="file" id="thefile" name='upload' onChange={(e)=>this.getFileName(e)} />
        </label>
      </div>
    );
  }
}

export default PetImgUpload;

{
  /*  */
}
{
  /* <form action="upload_test.php" enctype="multipart/form-data" method="post">
  <input type="file" name="avatar" />
  <button name="upload" value="true">
    upload
  </button>
</form>; */
}
{
  /* <div>
      <div className="picture">
        <img src={photo} />
      </div>
      <form
        className="upload_form"
        action="upload_test.php"
        enctype="multipart/form-data"
        method="post"
      >
        <input type="file" name="avatar" />
        <button className="btn btn-default" name="upload" value="true">
          upload
        </button>
      </form>
    </div> */
}
