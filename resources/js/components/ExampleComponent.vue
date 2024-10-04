<template>
  <div class="menu-slider">
    <div v-if="menuItems.length > 0">
  <div class="custom-background">
    <!-- Restaurant Name Box -->
    <div class="restaurant-box">
      <!-- <img v-if="restaurant.logo" :src="restaurant.logo" alt="Restaurant Logo" class="restaurant-logo" /> -->
      <span class="restaurant-name">{{ currentMenuItem.client_domain_name }} Restaurent</span>
    </div>

    <!-- Transparent Navbar -->
    <nav class="custom-navbar">
      <ul class="nav-menu">
        <li class="center-text"><span :class="['badge', currentMenuItem.menu_type === 1 ? 'veg-badge' : '']">
          {{ currentMenuItem.menu_type === 1 ? 'VEG' : 'NON-VEG' }}
        </span></li>
        <li><span class="price-tag">₹ {{ currentMenuItem.menu_price }}</span></li>
      </ul>
    </nav>

    <div class="item-name-wrapper">
      <h1 class="item-name">{{ currentMenuItem.menu_name }}</h1>
    </div>

    <div class="ingredients-wrapper">
      <div class="ingredients">
        <strong>Ingredients:</strong>
        <div v-html="currentMenuItem.menu_description"></div>
      </div>
    </div>

    <!-- Image Container -->
    <div class="img-container-wrapper">
      <div class="img-container">
        <img :src="getImageUrl(currentMenuItem.menu_image)" :alt="currentMenuItem.menu_name" id="item-image">
      </div>
    </div>

    <!-- Footer content -->
    <footer class="custom-footer">
      <span>&copy; 2024 <a href="https://welcomewebworks.com" class="footer-link"> WELCOME WEB WORKS</a>. All rights reserved.</span>
    </footer>
  </div>
</div>
</div>
</template>

<script>
export default {
  name: 'CustomBackground',
  props: ['domainName'],
  data() {
    return {
      menuItems: [], // Holds the fetched menu data
      currentIndex: 0, // Track the currently displayed item
      loading: true, // Track loading state
      error: null, // Track errors if any occur
      touchStartX: 0, // To store the initial touch position
      touchEndX: 0 // To store the final touch position
    };
  },
  computed: {
    currentMenuItem() {
      return this.menuItems[this.currentIndex];
    }
  },
  mounted() { // Fetch the restaurant data when component is mounted
    this.fetchMenuItems();

    // Add event listeners for touch gestures
    const slider = document.querySelector('.menu-slider');
    slider.addEventListener('touchstart', this.handleTouchStart, { passive: false }); // { passive: false } is important to prevent scrolling
    slider.addEventListener('touchend', this.handleTouchEnd);
  },
  methods: {

    async fetchMenuItems() {
      try {
        const response = await fetch(`/api/menu-items?domainName=${this.domainName}`); // Use the domainName in the API request
        const data = await response.json();
        this.menuItems = data;
      } catch (error) {
        this.error = 'Failed to load menu items.';
      } finally {
        this.loading = false;
      }
    },

    getImageUrl(imagePath) {
      return `/storage/${imagePath}`;
    },
    slideRight() {
      if (this.currentIndex < this.menuItems.length - 1) {
        this.currentIndex++;
      }
    },
    slideLeft() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    },
    addToOrder(menuItem) {
      // Logic to add the selected menu item to an order
      console.log('Adding to order:', menuItem);
    },
    handleTouchStart(event) {
      event.preventDefault(); // Prevent default scroll behavior
      this.touchStartX = event.changedTouches[0].screenX;
    },
    handleTouchEnd(event) {
      this.touchEndX = event.changedTouches[0].screenX;
      this.handleSwipe();
    },
    handleSwipe() {
      if (this.touchEndX < this.touchStartX) {
        this.slideRight();
      } else if (this.touchEndX > this.touchStartX) {
        this.slideLeft();
      }
    }
  },
};
</script>
<style>
/* Apply global styles for html and body */
html, body {
  height: -webkit-fill-available;
  margin: 0;
  padding: 0;
  color: white;
}
</style>

<style scoped>
 /* Custom Background */
.custom-background {
  /* Fullscreen setup */
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100%; /* Changed from 100vh to 100% to avoid issues with mobile browser UI */
  overflow: hidden;
  
  /* Gradient background */
  background: linear-gradient(35deg, 
    rgba(0, 100, 0, 1) 0%,    
    rgba(0, 100, 0, 1) 10%,   
    rgb(0, 0, 0) 50%,     
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
  color: #e4e4e4; /* Gold color for restaurant name */
  font-size: 1.4rem;
  font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-family: 'Roboto', sans-serif;;
}





/* Transparent Navbar */
.custom-navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  top: 100px; /* Position below the restaurant box */
  left: 0;
  right: 0;
  padding: 0 40px;
  z-index: 10;
}

.nav-menu {
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
}

.badge {
  font-size: 0.9rem;
  font-weight: bold;
  background-color: #eab5b5;
  color: rgb(134, 0, 0);
  font-family: 'Flavors', cursive;
  padding: 1px 10px;
  border-radius: 20px;
}

.veg-badge {
  background-color: #99eda4;
  color: #006f0f;
  font-family: 'Flavors', cursive;
}

.price-tag {
  font-size: 1.5rem;
  font-weight: bold;
  font-family: 'Flavors', cursive;
  
}


.item-name-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  top: 130px; /* Position below the restaurant box */
  left: 0;
  right: 0;
  padding: 0 20px;
  z-index: 10;
}

.item-name {
  text-align: center;
  margin: 10px 0;
  width: 100%;
  font-size: clamp(1.5rem, 5vw, 1.8rem);
  white-space: nowrap;
  overflow: hidden;
  font-family: 'Flavors';
}

.ingredients-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  top: 190px; /* Position below the restaurant box */
  left: 0;
  right: 0;
  padding: 0 20px;
  z-index: 10;
}

.ingredients {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  width: 100%;
  height: 140px;
  overflow: hidden;
  text-align: justify;
}

.ingredients div {
  font-size: 14px;
  line-height: 1.5;
  overflow: hidden;
}



.img-container {
  position: relative;
  top: 330px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.img-container img {
  width: 180px;
  height: 180px;
  border-radius: 100px;
  z-index: 2;
  transition: transform 0.5s;
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
  
  /* Ensuring space for iPhone notches */
  padding-bottom: env(safe-area-inset-bottom, 0);
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

  .restaurant-name {
   font-size: 1.2rem;
  }

  .custom-navbar {
    top: 85px; /*Navigation Bar Position below the restaurant box */
    padding: 0 25px;
  }

  .custom-footer {
    font-size: 0.8rem; /* Further reduce footer font size */
    padding: 0.4rem 0;
    padding-bottom: env(safe-area-inset-bottom, 0.5rem);
  }

}
</style>
