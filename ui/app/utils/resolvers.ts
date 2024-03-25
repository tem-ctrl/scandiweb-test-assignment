import * as Yup from 'yup';
import { Product, ProductType } from 'app/utils/types';
import { ERRORS, PROPERTY_MAP } from 'app/utils/constants';

/**
 * Create default form values base on product type
 * @param {Productype} productType
 * @returns {Object} Customized default form values
 */
export const setDefaultFormValues = (
	productType: ProductType
): Pick<Product, 'name' | 'sku' | 'price' | 'type'> => {
	let fixedValues = { sku: '', name: '', price: 0 };
	let keys = PROPERTY_MAP[productType].attributes;
	let otherValues = Object.fromEntries(keys.map((_, i) => [keys[i], 0]));

	return { ...fixedValues, type: productType, ...otherValues };
};

const productTypes: ProductType[] = ['dvd', 'book', 'furniture'];
const positiveNumber = Yup.number()
	.positive(ERRORS.required)
	.typeError(ERRORS.type)
	.transform((value) => (value ? Number(value) : 0));
const requiredString = Yup.string().required(ERRORS.required).typeError(ERRORS.type);

export const addProductFormSchema = Yup.object().shape({
	sku: requiredString,
	name: requiredString,
	price: positiveNumber.required(ERRORS.required),
	type: Yup.string().required().oneOf(productTypes, ERRORS.type),
	size: positiveNumber.when('type', ([type], schema) => {
		return type === 'dvd' ? schema.required(ERRORS.required) : schema;
	}),
	weight: positiveNumber.when('type', ([type], schema) => {
		return type === 'book' ? schema.required(ERRORS.required) : schema;
	}),
	length: positiveNumber.when('type', ([type], schema) => {
		return type === 'furniture' ? schema.required(ERRORS.required) : schema;
	}),
	width: positiveNumber.when('type', ([type], schema) => {
		return type === 'furniture' ? schema.required(ERRORS.required) : schema;
	}),
	height: positiveNumber.when('type', ([type], schema) => {
		return type === 'furniture' ? schema.required(ERRORS.required) : schema;
	}),
});

export type AddProductFormFields = Yup.InferType<typeof addProductFormSchema>;
