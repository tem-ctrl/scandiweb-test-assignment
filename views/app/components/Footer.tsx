import { FaGithub, FaLinkedin, FaWhatsapp } from 'react-icons/fa';
import { TbWorld } from 'react-icons/tb';
import Link from 'next/link';

type FooterLink = {
	href: string;
	icon: React.ReactNode;
  name: string;
};

const FooterItem = ({ href, icon, name }: FooterLink) => {
	return (
		<Link href={href} target='_blank' className='footer-link'>
			<span className='footer-icon'>{icon}</span>
      <span className='sr-only'>{name}</span>
		</Link>
	);
};

const Footer = () => {
	const FOOTER_LINKS: FooterLink[] = [
		{
			href: 'https://linkedin.com/in/temgoua',
			icon: <FaLinkedin />,
      name: 'LinkedIn profile',
		},
		{
			href: 'https://github.com/tem-ctrl',
			icon: <FaGithub />,
      name: 'GitHub profile',
		},
		{
			href: 'https://wa.me/237651331062',
			icon: <FaWhatsapp />,
      name: 'WhatsApp contact',
		},
		{
			href: 'https://gtemgoua.vercel.app',
			icon: <TbWorld />,
      name: 'Personal website and portfolio'
		},
	];

	return (
		<footer className='footer'>
			<h2 className='footer-title'>Scandiweb Test Assignment</h2>
			<div className='footer-links'>
				{FOOTER_LINKS.map((item, i) => (
					<FooterItem key={`footer-link-${i}`} {...item} />
				))}
			</div>
			<p className='footer-copyright'>© 2023 Gilbert Temgoua</p>
		</footer>
	);
};

export default Footer;
