<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { AnimalType } from '../types/enum/animalsTypeEnum';
import { BreedCategory } from '../types/enum/breedCategoryEnum';
import { ApiBreedService } from '../services/apiBreed';
import type { Breed } from '../types/model/breed';

const emit = defineEmits<{
    (e: 'filter', filters: { type: AnimalType | '', breed: string }): void
}>()

const apiBreed = new ApiBreedService()
const breeds = ref<Breed[]>([])
const selectedType = ref<AnimalType | ''>('')
const selectedBreed = ref<string>('')

const loadBreeds = async (type?: string) => {
  try {
    if (type) {
      breeds.value = await apiBreed.getBreedsByType(type);
    } else {
      breeds.value = await apiBreed.getAllBreeds();
    }
    selectedBreed.value = ''; // Reset breed selection when breeds change
  } catch (error) {
    console.error('Error loading breeds:', error);
  }
}

onMounted(() => {
  loadBreeds();
});

const handleTypeChange = async () => {
  if (selectedType.value) {
    await loadBreeds(selectedType.value);
  } else {
    await loadBreeds();
  }
  handleFilter();
}

const handleFilter = () => {
  emit('filter', {
    type: selectedType.value,
    breed: selectedBreed.value
  })
}

const resetFilters = () => {
  selectedType.value = ''
  selectedBreed.value = ''
  loadBreeds();
  handleFilter()
}
</script>

<template>
  <div class="filter-container">
    <div class="filter-group">
      <label for="type">Animal Type:</label>
      <select id="type" v-model="selectedType" @change="handleTypeChange">
        <option value="">All Types</option>
        <option :value="AnimalType.BOVINS">Bovins</option>
        <option :value="AnimalType.OVINS">Ovins</option>
      </select>
    </div>

    <div class="filter-group">
      <label for="breed">Breed:</label>
      <select id="breed" v-model="selectedBreed" @change="handleFilter">
        <option value="">All Breeds</option>
        <option v-for="breed in breeds" :key="breed.id" :value="breed.id">
          {{ breed.name }}
        </option>
      </select>
    </div>

    <button class="reset-button" @click="resetFilters">Reset Filters</button>
  </div>
</template>

<style scoped>
.filter-container {
  display: flex;
  gap: 20px;
  align-items: flex-end;
  margin-bottom: 20px;
  padding: 15px;
  background-color: #f8f9fa;
  border-radius: 8px;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

label {
  font-weight: 500;
  color: #2c3e50;
}

select {
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 0.9em;
  min-width: 150px;
}

.reset-button {
  padding: 8px 16px;
  background-color: #e9ecef;
  border: 1px solid #ddd;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.9em;
  color: #2c3e50;
}

.reset-button:hover {
  background-color: #dee2e6;
}

@media (max-width: 768px) {
  .filter-container {
    flex-direction: column;
    align-items: stretch;
  }
  
  .filter-group {
    width: 100%;
  }
  
  select {
    width: 100%;
  }
}
</style> 