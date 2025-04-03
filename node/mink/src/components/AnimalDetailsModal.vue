<script setup lang="ts">
import { defineProps } from 'vue'
import type { Animal } from '../types/model/animal'

defineProps<{
  animal: Animal
}>()

</script>

<template>
  <div class="modal-overlay" @click="$emit('close')">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>{{ animal.breed.name }} - {{ animal.breed.type }} - {{ animal.breed.category }}</h2>
        <button class="close-button" @click="$emit('close')">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="image-container">
          <img 
            :src="`http://localhost/images/${animal.picture}`" 
            :alt="`${animal.breed.name} image`"
            class="animal-image"
          >
        </div>
        <div class="details-container">
          <div class="detail-row">
            <span class="label">Age:</span>
            <div class="value-box">
              <span class="value">{{ animal.age }} years</span>
            </div>
          </div>
          <div class="detail-row">
            <span class="label">Prix:</span>
            <div class="value-box">
              <div class="prices-container">
                <span class="value">{{ animal.priceExcludingTax }}€ ht</span>
                <span class="price-separator">|</span>
                <span class="value">{{ animal.fullPrice?.toFixed(2) }}€ ttc</span>
              </div>
            </div>
          </div>
          <div class="detail-row" v-if="animal.description">
            <span class="label">Description:</span>
            <div class="value-box">
              <span class="value description-text">{{ animal.description }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background-color: white;
  border-radius: 8px;
  width: 90%;
  max-width: 600px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #dee2e6;
}

.modal-header h2 {
  margin: 0;
  color: #2c3e50;
  font-size: 1.5rem;
}

.close-button {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #6c757d;
}

.modal-body {
  padding: 1.5rem;
}

.image-container {
  width: 100%;
  margin-bottom: 1.5rem;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f8f9fa;
  height: 400px;
  position: relative;
}

.animal-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.details-container {
  background-color: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
}

.detail-row {
  display: flex;
  margin-bottom: 1rem;
  align-items: flex-start;
}

.label {
  font-weight: 500;
  color: #495057;
  width: 150px;
  padding-top: 0.5rem;
}

.value-box {
  flex: 1;
  background-color: white;
  padding: 0.75rem;
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.value {
  color: #2c3e50;
  display: block;
}

.type-badge, .category-badge {
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.875rem;
  font-weight: 500;
}

.type-badge {
  background-color: #e3f2fd;
  color: #1976d2;
}

.category-badge {
  background-color: #f5f5f5;
  color: #424242;
}

.prices-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.price-separator {
  color: #6c757d;
  font-weight: 300;
}

.description-text {
  line-height: 1.5;
  text-align: center;
}

@media (max-width: 768px) {
  .modal-content {
    width: 95%;
  }
  
  .detail-row {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .label {
    margin-bottom: 0.5rem;
    width: 100%;
  }

  .value-box {
    width: 100%;
  }

  .prices-container {
    flex-direction: column;
    gap: 0.25rem;
  }
  
  .price-separator {
    display: none;
  }

  .image-container {
    height: 300px;
  }
}
</style> 