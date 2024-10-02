<template>
  <div class="custom-background">
    <!-- Restaurant Name Box -->
    <div class="restaurant-box" v-if="restaurant">
      <img v-if="restaurant.logo" :src="restaurant.logo" alt="Restaurant Logo" class="restaurant-logo" />
      <span class="restaurant-name">{{ restaurant.name }}</span>
    </div>

    <!-- Footer content -->
    <footer class="custom-footer">
      <span>&copy; 2024 <a href="https://welcomewebworks.com" class="footer-link">WELCOME WEB WORKS</a>. All rights reserved.</span>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'CustomBackground',
  data() {
    return {
      restaurant: null, // Will hold the restaurant data
    };
  },
  mounted() {
    this.fetchRestaurantData(); // Fetch the restaurant data when component is mounted
  },
  methods: {
    fetchRestaurantData() {
      // Simulate an API call to fetch restaurant data from the database
      setTimeout(() => {
        this.restaurant = {
          name: 'LUCKEY Restaurants', // Dynamically fetched restaurant name
          logo: 'https://static.vecteezy.com/system/resources/previews/025/270/679/original/kfc-logo-editorial-free-vector.jpg', // Dynamically fetched logo
        };
      }, 1000); // Simulating delay
    },
  },
};
</script>
<style>
/* Apply global styles for html and body */
html, body {
  height: 100%;
  height: -webkit-fill-available;
  margin: 0;
  padding: 0;
}
</style>

<style scoped>
.custom-background {
  /* Fullscreen setup */
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;

  /* Prevent scrolling */
  overflow: hidden;

  /* Gradient background */
  background: linear-gradient(35deg, 
    rgba(0, 100, 0, 1) 0%,    
    rgba(0, 100, 0, 1) 10%,   
    rgba(0, 0, 0, 1) 50%,     
    rgba(0, 100, 0, 1) 100%);
  background-size: cover;
  background-position: center;
}

/* Restaurant Name Box Styling */
.restaurant-box {
  position: absolute;
  top: 15px; /* Position in the top left corner */
  left: 12px;
  display: flex;
  align-items: center;
  padding: 6px 12px;
  
  /* Set circular cut edges on the corners */
  border-radius: 50px 150px 50px 150px; /* Circular cut edges */
  
  background: none; /* No background for the box */
}

/* Restaurant Logo Styling */
.restaurant-logo {
  width: 60px;
  height: 60px;
  margin-right: 10px;
  object-fit: cover;
  border-radius: 50%; /* Circular logo */
  border: 2px solid green; /* Simple green border */
}

/* Restaurant Name Styling */
.restaurant-name {
  color: #FFD700; /* Gold color for restaurant name */
  font-size: 1.4rem;
  font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Footer styling */
.custom-footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
  padding: 0.2rem 0;
  background-color: black;
  font-family: Arial, sans-serif;
  color: white;
  font-size: 0.6rem;
}

.footer-link {
  background: linear-gradient(35deg, 
    rgb(255, 215, 0) 0%,   /* Gold color */
    rgb(218, 165, 32) 50%, /* Deep gold color */
    rgb(255, 223, 0) 100%  /* Lighter gold color */
  ); 
  background-clip: text;
  -webkit-background-clip: text; /* For Safari compatibility */
  color: transparent; /* Hide the original text color */
  text-decoration: none;
  font-weight: bold;
}

.footer-link:hover {
  text-decoration: underline;
}


/* Responsive Design */
@media screen and (max-width: 768px) {
  .restaurant-box {
    font-size: 1rem; /* Smaller font size */
    padding: 4px 8px; /* Adjust padding */
  }

  .restaurant-logo {
    width: 30px;
    height: 30px; /* Smaller logo */
  }

  .custom-footer {
    font-size: 0.9rem; /* Adjust font size for footer */
  }
}

@media screen and (max-width: 480px) {
  .restaurant-box {
    font-size: 0.5rem;
    padding: 2px 4px; /* Even smaller padding */
  }

  .restaurant-logo {
    width: 45px;
    height: 45px; /* Smaller logo */
  }

  .custom-footer {
    font-size: 0.8rem; /* Further reduce footer font size */
    padding: 0.4rem 0;
  }
  .restaurant-name {
  font-size: 1.2rem;
}
}
</style>
