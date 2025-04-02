export enum AnimalType {
    BOVINS = 'bovin',
    OVINS = 'ovin'
}

export function parseAnimalType(type: string): AnimalType {
  return type.toLowerCase() === 'bovin' ? AnimalType.BOVINS : AnimalType.OVINS;
}