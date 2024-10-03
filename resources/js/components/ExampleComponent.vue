<template>
  <div class="menu-slider">
    <div v-if="menuItems.length > 0">
  <div class="custom-background">
    <!-- Restaurant Name Box -->
    <div class="restaurant-box" v-if="restaurant">
      <img v-if="restaurant.logo" :src="restaurant.logo" alt="Restaurant Logo" class="restaurant-logo" />
      <span class="restaurant-name">{{ restaurant.name }}</span>
    </div>

    <!-- Transparent Navbar -->
    <nav class="custom-navbar">
      <ul class="nav-menu">
        <li class="menu-button" @click="toggleSidebar">
          <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="30">
            <path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z" />
          </svg>
        </li>
        <li class="center-text"><span :class="['badge', currentMenuItem.menu_type === 1 ? 'veg-badge' : '']">
          {{ currentMenuItem.menu_type === 1 ? 'VEG' : 'NON-VEG' }}
        </span></li>
        <li><span class="price-tag">₹ {{ currentMenuItem.menu_price }}</span></li>
      </ul>
    </nav>
    <!-- Sliding Sidebar -->
    <ul class="sidebar" v-show="isSidebarVisible">
      <li @click="toggleSidebar">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
            <path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z" />
          </svg>
        </a>
      </li>
      <li><a href="#">Blog</a></li>
      <li><a href="#">Products</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Forum</a></li>
      <li><a href="#">Login</a></li>
    </ul>

    <!-- Footer content -->
    <footer class="custom-footer">
      <span>&copy; 2024 <a href="https://welcomewebworks.com" class="footer-link">WELCOME WEB WORKS</a>. All rights reserved.</span>
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
      restaurant: null, // Will hold the restaurant data
      isSidebarVisible: false, // Control visibility of sidebar
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
  mounted() {
    this.fetchRestaurantData(); // Fetch the restaurant data when component is mounted
    // Fetch menu items when the component is mounted
    this.fetchMenuItems();

    // Add event listeners for touch gestures
    const slider = document.querySelector('.menu-slider');
    slider.addEventListener('touchstart', this.handleTouchStart, { passive: false }); // { passive: false } is important to prevent scrolling
    slider.addEventListener('touchend', this.handleTouchEnd);
  },
  beforeDestroy() {
    // Clean up event listeners to avoid memory leaks
    const slider = document.querySelector('.menu-slider');
    slider.removeEventListener('touchstart', this.handleTouchStart);
    slider.removeEventListener('touchend', this.handleTouchEnd);
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
    toggleSidebar() {
      this.isSidebarVisible = !this.isSidebarVisible; // Toggle sidebar visibility
      console.log('Sidebar Visibility:', this.isSidebarVisible); // Debugging log
      // Add or remove the "is-visible" class
      const sidebar = document.querySelector('.sidebar');
      if (this.isSidebarVisible) {
        sidebar.classList.add('is-visible');
      } else {
        sidebar.classList.remove('is-visible');
      }
    },

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

.menu-button {
  cursor: pointer;
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

/* Sidebar styling */
.sidebar {
  position: fixed;
  top: 57px;
  left: 0;
  right: 0;
  height: 100%; /* Add height */
  background-color: rgb(0, 0, 0);
  box-shadow: -10px 0 10px rgba(0, 0, 0, 0.1);
  list-style: none;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 20px;
  transition: transform 0.3s ease-in-out; /* Added transform transition */
  transform: translateX(-100%); /* Start hidden off-screen */
  z-index: 9;
}

/* When sidebar is visible */
.sidebar.is-visible {
  transform: translateX(0); /* Slide-in animation */
}


.sidebar li {
  width: 100%;
  margin: 10px 0;
}

.sidebar a {
  width: 100%;
  color: white;
  text-decoration: none;
}

.sidebar svg {
  cursor: pointer;
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
