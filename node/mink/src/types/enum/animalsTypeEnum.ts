export enum AnimalType {
    BOVINS = 'bovins',
    OVINS = 'ovins'
}

export function parseAnimalType(type: string): AnimalType {
  return type.toLowerCase() === 'bovins' ? AnimalType.BOVINS : AnimalType.OVINS;
}