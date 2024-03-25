import { FIXED_ATTRIBUTES, PROPERTY_MAP } from 'app/utils/constants';
import { AddProductFormFields } from 'app/utils/resolvers';
import { ProductType } from 'app/utils/types';

export const sanitizeData = (data: AddProductFormFields) => {
	data.type = data.type.toLowerCase() as ProductType;
	let attributes = FIXED_ATTRIBUTES.concat(PROPERTY_MAP[data.type].attributes);

	return Object.fromEntries(Object.entries(data).filter((p) => attributes.includes(p[0])));
};
