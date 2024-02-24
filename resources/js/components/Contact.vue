<template>
    <div class="container">
    <div class="card mt-4" style="border-radius: 25px">
      <div
        class="card-body"
        style="
        height: 300px;
        background-size: cover;
        background-position: center;
        background-image: linear-gradient(2deg, black, transparent), url('https://cdn.pixabay.com/photo/2017/10/12/22/17/business-2846221_960_720.jpg');
        border-radius: 25px;">
        <div style="position: absolute; bottom: 0; margin: 10px;" class="text-white">
            <h1>
                Kontak Sahretech
            </h1>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos doloremque exercitationem laudantium, 
            </p>
          <router-link :to="{ name: 'home'}" class="btn btn-dark me-2 mb-4 mt-3">Home</router-link>
          <router-link :to="{ name: 'about'}" class="btn btn-dark me-2 mb-4 mt-3">About</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {


    }
</script>