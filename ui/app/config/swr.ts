import type { SWRConfiguration } from 'swr';
import axios from 'axios';

export const swrDefaultConfig: SWRConfiguration = {
	fetcher: (url) => axios.get(url).then((res) => res.data),
	errorRetryCount: 2,
	dedupingInterval: 5000,
	revalidateOnMount: true,
	revalidateOnReconnect: true,
	revalidateIfStale: false,
	revalidateOnFocus: false,
};
