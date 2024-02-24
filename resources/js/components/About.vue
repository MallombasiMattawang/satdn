<template>
      <div class="container">
        <div class="card mt-4" style="border-radius: 25px">
          <div
            class="card-body"
            style="
              height: 300px;
              background-size: cover;
              background-position: center;
              background-image: linear-gradient(2deg, black, transparent),url('https://cdn.pixabay.com/photo/2014/08/05/10/30/iphone-410324_960_720.jpg');
              border-radius: 25px;
            ">
            <div
              style="position: absolute; bottom: 0; margin: 10px"
              class="text-white">
              <h1>Tentang Sahretech</h1>
              <p>
                Sahretech adalah situs belajar pemrograman, tutorial blogger dan
                wordpress, <br />
                tutorial office, dan pembahasan mengenai komputer lainnya.
              </p>
              <router-link :to="{ name: 'home'}" class="btn btn-dark me-2 mb-4 mt-3">Home</router-link>
              <router-link :to="{ name: 'contact'}" class="btn btn-dark me-2 mb-4 mt-3">Contact</router-link>
            </div>
          </div>
        </div>
      </div>
</template>
    
<script>
    export default {
        
    };
</script>