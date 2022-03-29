<html>
  <head>
    <!-- Moralis SDK code -->
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script src="https://unpkg.com/moralis/dist/moralis.js"></script>
  </head>
  <body>
    <h1>Gas Stats With Moralis</h1>

    <button id="btn-login" onclick="login()">Login</button><br />
    <input type="text" name="metadataName" id="metadataName" /><br />
    <textarea name="metadataDescription" id="metadataDescription"></textarea><br/>
    <input type="file" name="fileInput" id="fileInput" /><br />
    <button  onclick=gogogo()>GOGOGO</button>

    <script>
      // connect to Moralis server

      const serverUrl = "https://dgp8u5u8wg0f.usemoralis.com:2053/server";
      const appId = "YyUUWPFVvGvrcOK7bky9rC92o0dQ8iUnS5Eua7ck";
      Moralis.start({ serverUrl, appId });
    
    //   Moralis.initialize("YyUUWPFVvGvrcOK7bky9rC92o0dQ8iUnS5Eua7ck");
    // Moralis.serverURL ="https://dgp8u5u8wg0f.usemoralis.com:2053/server";

    //login function
    login = async() => {
        // Moralis.authenticate().then(function (user) {
        //     console.log("login in")
        // })
        let user = Moralis.User.current();
        if (!user) {
            user = await Moralis.authenticate({ signingMessage: "Log in using Moralis" })
            .then(function (user) {
                console.log("logged in user:", user);
                console.log(user.get("ethAddress"));
            })
            .catch(function (error) {
                console(error);
            });
        }
    }


    // Save file input to IPFS

    uploadImage = async () => {
        const data = fileInput.files[0];
        data.title='aaaa';
        console.log('aaaaaa '+data.name);
        console.log('aaaaaa '+data.title);
        const file = new Moralis.File(data.name, data);
        await file.saveIPFS();
        console.log(file.ipfs(), file.hash());
        return file.ipfs();
    }
   
    //update metadata

    uploadMetadata = async (imageURL) => {
        

        const name = document.getElementById('metadataName').value();
        const description = document.getElementById('metadataDescription').value();

        const metadata= {
            "name" : name,
            "description" : description,
            "image" : imageURL
        }

        const file = new Moralis.File("file.json", {base64 : btoa(JSON.stringify(metadata))});
        await file.saveIPFS();

        console.log(file.ipfs());
    }
    
//gogogo

gogogo = async () =>{
    const image = await uploadImage();
    console.log('cccccccccc '+image);
    await uploadMetadata(image);
}

    </script>
  </body>
</html>