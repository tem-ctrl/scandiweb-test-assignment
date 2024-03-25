import 'app/globals.scss';
import 'react-toastify/dist/ReactToastify.min.css';
import { Inter } from 'next/font/google';
import Footer from 'app/components/Footer';
import AppProvider from 'app/providers/AppProvider'
import type { Metadata } from 'next';

const inter = Inter({ subsets: ['latin'], display: 'swap' });

export const metadata: Metadata = {
	title: 'Scandiweb Junior Developer Test Assignment',
	authors: {
    name: 'Gilbert Temgoua',
    url: 'https://gtemgoua.vercel.app',
  },
  metadataBase: new URL(process.env.NEXT_PUBLIC_URL ?? '/'),
  openGraph: {
    images: '/opengraph-image.png',
  },
  twitter: {
    images: '/twitter-image.png',
  },
};

const RootLayout = ({ children }: { children: React.ReactNode }) => {
	return (
		<html lang='en'>
			<body className={`${inter.className}`}>
				<AppProvider>
					{children}
					<Footer />
				</AppProvider>
			</body>
		</html>
	);
};

export default RootLayout;
