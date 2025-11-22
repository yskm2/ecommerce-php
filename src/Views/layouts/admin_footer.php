</div>
<script>
	(function(){
		const btn = document.getElementById('adminHamburger');
		const menu = document.getElementById('adminMobileMenu');
		if (!btn || !menu) return;

		function openMenu(){
			menu.setAttribute('aria-hidden','false');
			btn.setAttribute('aria-expanded','true');
			document.body.style.overflow = 'hidden';
		}
		function closeMenu(){
			menu.setAttribute('aria-hidden','true');
			btn.setAttribute('aria-expanded','false');
			document.body.style.overflow = '';
		}
		function toggle(){
			const hidden = menu.getAttribute('aria-hidden') !== 'false';
			hidden ? openMenu() : closeMenu();
		}
		btn.addEventListener('click', toggle);
		menu.addEventListener('click', (e)=>{
			if (e.target === menu) closeMenu();
		});
		document.addEventListener('keydown', (e)=>{
			if (e.key === 'Escape') closeMenu();
		});
	})();
 </script>
</body>
</html>