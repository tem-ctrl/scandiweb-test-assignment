export type ProductType = 'book' | 'dvd' | 'furniture';

export type Product = {
	sku: string;
	name: string;
	price: number;
	type: ProductType;
	size?: number;
	weight?: number;
	width?: number;
	height?: number;
	length?: number;
}

export type ProductProperty = 'size' | 'weight' | 'dimensions' | 'width' | 'height' | 'length';

export type ProductProperties = {
	property: ProductProperty;
	attributes: ProductProperty[];
	cardLabel: string[];
};

export interface ProductCardProps extends Product {
	property: string;
}

export type ToDeleteListType = Record<ProductType, string[]>;

export type ProductToDelete = Pick<Product, 'type'|'sku'>;
