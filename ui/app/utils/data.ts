import { Product, ProductCardProps, ProductType } from 'app/utils/types';

/**
 * Prepare received data for displaying on the homepage
 * @param {Product} data data received from API
 * @returns {Object} prepared data
 */
export const prepareData = (data: Product): ProductCardProps => {
	let propertyMap: Record<ProductType, string> = {
		dvd: String(data['size']),
		book: String(data['weight']),
		furniture: `${data['height']}x${data['width']}x${data['length']}`,
	};

	return { ...data, property: propertyMap[data.type] };
};
