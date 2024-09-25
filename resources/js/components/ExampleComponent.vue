<template>
  <div class="menu-slider">
    <!-- Display current menu item details if available -->
    <div v-if="menuItems.length > 0" class="menu-item">
      <div class="header">
        <!-- Dynamic Client Logo -->
        <div class="company_name">
          <h3>{{ currentMenuItem.client_domain_name }}</h3>
        </div>
      </div>
      <div class="header-row">
        <span :class="['badge', currentMenuItem.menu_type === 1 ? 'veg-badge' : '']">
          {{ currentMenuItem.menu_type === 1 ? 'VEG' : 'NON VEG' }}
        </span>
        <span class="price-tag">₹ {{ currentMenuItem.menu_price }}</span>
      </div>
      <!-- Item Name -->
      <div class="item-name">{{ currentMenuItem.menu_name }}</div>
      <!-- Ingredients -->
      <div class="ingredients">
        <strong>Ingredients:</strong>
        <div v-html="currentMenuItem.menu_description"></div>
      </div>
      <!-- Image Container -->
      <div class="img-container">
        <img :src="getImageUrl(currentMenuItem.menu_image)" :alt="currentMenuItem.menu_name" id="item-image">
      </div>
      <!-- Add to Order Button -->
      <div class="text-center">
        <button class="order-btn" @click="addToOrder(currentMenuItem)">+ Add to Order</button>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="nav-buttons">
      <button @click="slideLeft" :disabled="currentIndex === 0">&#9664;</button>
      <button @click="slideRight" :disabled="currentIndex === menuItems.length - 1">&#9654;</button>
    </div>

    <!-- Footer -->
    <div class="copyright">
      <p>
        COPYRIGHT BY <span style="color: silver;">©</span>
        <b><a href="#"><span style="color: rgb(146, 126, 14);">WELCOME WEB WORKS</span></a></b>
      </p>
    </div>

    <!-- Loading state -->
    <div v-if="loading">Loading menu items...</div>

    <!-- Error state -->
    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script>
export default {
  props: ['domainName'], // Accept the domainName as a prop
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
  mounted() {
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
  }
};
</script>

<style scoped>
/* Disable horizontal scrolling for the entire page */
html, body {
  overflow-x: hidden; /* Prevent horizontal scrolling on the body */
}

.menu-slider {
  text-align: center;
  margin: 0 auto;
  background-color: #000000;
  color: rgb(255, 255, 255);
  overflow: hidden; /* Ensure no content overflow in the slider */
  position: relative; /* Important for positioning children like nav buttons */
}

.copyright {
  background-color: #ffffff;
  color: rgb(0, 0, 0);
  text-align: center;
  padding: 10px;
  font-size: 0.8rem;
  margin-top: auto;
  padding-bottom: 0px;
}

.menu-item img {
  width: 100%;
  height: auto;
}

.navigation-buttons button {
  margin: 10px;
}

.error {
  color: red;
}

.header {
  display: flex;
  justify-content: left;
  align-items: center;
  padding: 10px;
  padding-top: 25px;
  width: 100%;
  max-width: 300px;
  height: 100px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.company_name h3 {
  font-size: 1.2rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 100%;
}

img {
  max-width: 100%;
  max-height: 100px;
  object-fit: contain;
  overflow: hidden;
}

.header-row {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  position: relative;
}

.badge {
  font-size: 0.9rem;
  font-weight: bold;
  background-color: #eab5b5;
  color: rgb(134, 0, 0);
  padding: 5px 10px;
  border-radius: 20px;
}

.veg-badge {
  background-color: #99eda4;
  color: #006f0f;
}

.price-tag {
  font-size: 1.5rem;
  font-weight: bold;
  position: absolute;
  right: 20px;
}

.item-name {
  text-align: center;
  margin: 10px 0;
  width: 100%;
  font-size: clamp(1rem, 5vw, 1.8rem);
  white-space: nowrap;
  overflow: hidden;
}

.ingredients {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  width: 100%;
  height: 150px;
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
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.img-container img {
  width: 200px;
  height: 200px;
  border-radius: 25px;
  z-index: 2;
  transition: transform 0.5s;
}

.order-btn {
  background-color: #FF5656;
  color: white;
  border-radius: 25px;
  padding: 10px 20px;
  font-size: 1rem;
  font-weight: bold;
  text-transform: uppercase;
  margin: 20px 0;
}

.nav-buttons {
  display: flex;
  justify-content: space-between;
  margin: 10px 20px;
}

.nav-buttons button {
  background-color: transparent;
  border: none;
  font-size: 2rem;
  color: rgb(255, 0, 0);
}
</style>
