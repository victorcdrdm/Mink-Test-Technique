<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { ApiAnimalService } from '../services/apiAnimal'
import type { Animal } from '../types/model/animal'
import type { User } from '../types/model/user'
import { AnimalType } from '../types/enum/animalsTypeEnum'
import AnimalFilter from './AnimalFilter.vue'
import { ApiAuthService } from '../services/apiAuth'
import AnimalDetailsModal from './AnimalDetailsModal.vue'

const apiAnimalService = new ApiAnimalService()
const animals = ref<Animal[]>([])
const user = ref<User | null>(null)
const loading = ref(false)
const error = ref<string | null>(null)
const apiAuthService = new ApiAuthService()
const selectedAnimal = ref<Animal | null>(null)
const showModal = ref(false)

const loadAnimals = async (filters: { type: AnimalType | '', breed: string }) => {
  loading.value = true
  error.value = null
  try {
    if (filters.breed) {
      animals.value = await apiAnimalService.getAnimalsByBreeId(parseInt(filters.breed))
    } else if (filters.type) {
      animals.value = await apiAnimalService.getAnimalsByBreedType(filters.type)
    } else {
      animals.value = await apiAnimalService.getAllAnimalsForUser()
    }
  } catch (err) {
    error.value = 'Error loading animals'
    console.error('Error loading animals:', err)
  } finally {
    loading.value = false
  }
}

const getPhoneNumber = async () => {
  user.value = await apiAuthService.getUser()
}

const handleFilter = async (filters: { type: AnimalType | '', breed: string }) => {
  await loadAnimals(filters)
}

const openModal = (animal: Animal) => {
  selectedAnimal.value = animal
  showModal.value = true
}

const closeModal = () => {
  showModal.value = false
  selectedAnimal.value = null
}

onMounted(async () => {
  await loadAnimals({ type: '', breed: '' })
  await getPhoneNumber()
})
</script>

<template>
  <div class="animal-list">
    <AnimalFilter @filter="handleFilter" />
    
    <div v-if="loading" class="loading">
      Loading...
    </div>
    
    <div v-else-if="error" class="error">
      {{ error }}
    </div>
    
    <div v-else class="table-container">
      <table>
        <thead>
          <tr>
            <th>Race</th>
            <th>Type</th>
            <th>Catégorie</th>
            <th>Age</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="animal in animals" :key="animal['@id']" @click="openModal(animal)" class="clickable-row">
            <td>{{ animal.breed.name }}</td>
            <td><span class="type-badge">{{ animal.breed.type }}</span></td>
            <td><span class="category-badge">{{ animal.breed.category }}</span></td>
            <td>{{ animal.age }} ans</td>
            <td>{{ animal.priceExcludingTax }}</td>
            <td>{{ animal.fullPrice.toFixed(2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <AnimalDetailsModal 
      v-if="showModal && selectedAnimal" 
      :animal="selectedAnimal"
      @close="closeModal"
    />
  </div>
</template>

<style scoped>
.animal-list {
  width: 100%;
}

.loading, .error {
  text-align: center;
  padding: 2rem;
  font-size: 1.2rem;
}

.error {
  color: #dc3545;
}

.table-container {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
  background-color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #dee2e6;
}

th {
  background-color: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

tr:hover {
  background-color: #f8f9fa;
}

.clickable-row {
  cursor: pointer;
  transition: background-color 0.2s;
}

.clickable-row:hover {
  background-color: #e9ecef;
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

@media (max-width: 768px) {
  th, td {
    padding: 0.75rem;
    font-size: 0.875rem;
  }
  
  .type-badge, .category-badge {
    display: block;
    text-align: center;
  }
}
</style> 