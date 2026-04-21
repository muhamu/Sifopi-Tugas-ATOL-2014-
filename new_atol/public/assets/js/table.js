/**
 * SIFOPI - Table Utilities
 * Table interactions: sort, search, pagination
 */

const TableUtils = (() => {
    'use strict';

    // Setup sortable columns
    const setupSortable = (table) => {
        const headers = table.querySelectorAll('th[data-sort]');

        headers.forEach((header) => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                const column = header.dataset.sort;
                const direction = header.dataset.direction || 'asc';
                const newDirection = direction === 'asc' ? 'desc' : 'asc';

                // Update direction
                headers.forEach((h) => {
                    h.classList.remove('sorted-asc', 'sorted-desc');
                    delete h.dataset.direction;
                });

                header.dataset.direction = newDirection;
                header.classList.add(`sorted-${newDirection}`);

                // Sort table
                sortTable(table, column, newDirection);
            });
        });
    };

    // Sort table rows
    const sortTable = (table, column, direction) => {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            let aValue = a.querySelector(`td[data-column="${column}"]`)?.textContent.trim() || '';
            let bValue = b.querySelector(`td[data-column="${column}"]`)?.textContent.trim() || '';

            // Try to parse as numbers
            const aNum = parseFloat(aValue);
            const bNum = parseFloat(bValue);

            if (!isNaN(aNum) && !isNaN(bNum)) {
                return direction === 'asc' ? aNum - bNum : bNum - aNum;
            }

            // String comparison
            if (direction === 'asc') {
                return aValue.localeCompare(bValue);
            } else {
                return bValue.localeCompare(aValue);
            }
        });

        // Re-append sorted rows
        rows.forEach((row) => tbody.appendChild(row));
    };

    // Setup search/filter
    const setupSearch = (inputSelector, tableSelector) => {
        const input = SIFOPI.$(inputSelector);
        const table = SIFOPI.$(tableSelector);

        if (!input || !table) return;

        input.addEventListener('input', () => {
            const query = input.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                const matches = text.includes(query);
                row.style.display = matches ? '' : 'none';
            });
        });
    };

    // Show row details (if needed)
    const setupRowExpand = (table) => {
        SIFOPI.on('tr[data-expand]', 'click', (e) => {
            const row = e.currentTarget;
            const expanded = row.dataset.expanded === 'true';
            row.dataset.expanded = !expanded;

            // Toggle expansion
            const details = row.nextElementSibling;
            if (details && details.classList.contains('row-details')) {
                details.style.display = expanded ? 'none' : '';
            }
        });
    };

    // Delete row with confirmation
    const setupDelete = (table) => {
        SIFOPI.on('button[data-delete]', 'click', async (e) => {
            e.preventDefault();
            const button = e.currentTarget;
            const url = button.dataset.delete;

            const confirmed = await SIFOPI.confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmed) return;

            try {
                const response = await SIFOPI.api(url, { method: 'POST' });
                SIFOPI.notify('Data berhasil dihapus', 'success');

                // Remove row from table
                const row = button.closest('tr');
                row.style.opacity = '0';
                row.style.transition = 'opacity 0.3s';
                setTimeout(() => row.remove(), 300);
            } catch (error) {
                SIFOPI.notify('Gagal menghapus data', 'error');
            }
        });
    };

    // Setup all table interactions
    const initAll = () => {
        SIFOPI.$$('[data-sortable]').forEach((table) => {
            setupSortable(table);
        });

        SIFOPI.$$('[data-expandable]').forEach((table) => {
            setupRowExpand(table);
        });

        SIFOPI.$$('[data-deletable]').forEach((table) => {
            setupDelete(table);
        });
    };

    return {
        setupSortable,
        setupSearch,
        setupRowExpand,
        setupDelete,
        initAll,
    };
})();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => TableUtils.initAll());
} else {
    TableUtils.initAll();
}
