const apiHome = process.env.NEXT_PUBLIC_API_URL;

export const API = {
	getProducts: `${apiHome}/`,
	addProduct: `${apiHome}/add-product`,
	massDelete: `${apiHome}/mass-delete`,
} as const;
