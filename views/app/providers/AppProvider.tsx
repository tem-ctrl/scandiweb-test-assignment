'use client';

import { SWRConfig } from 'swr';
import { swrConfig } from '@/app/config/swr';
import { ToastContainer } from 'react-toastify';
import {ProductContextProvider} from '@/app/providers/ProductContextProvider';

const Providers = ({ children }: { children: React.ReactNode }) => {
	return (
		<SWRConfig value={swrConfig}>
			<ProductContextProvider>
				{children}
				<ToastContainer  />
			</ProductContextProvider>
		</SWRConfig>
	);
};

export default Providers;
