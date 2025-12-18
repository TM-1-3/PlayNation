function toggleReport(typeOrId, maybeId) {
  // signature: toggleReport(type, id) or fallback toggleReport(id)
  let type, id;
  if (maybeId === undefined) {
    // called with single numeric id (legacy)
    type = null;
    id = typeOrId;
  } else {
    type = typeOrId;
    id = maybeId;
  }

  const modalId = type ? `report-modal-${type}-${id}` : `report-modal-${id}`;
  const modal = document.getElementById(modalId);

  if (modal) {
    const isHidden = modal.classList.contains('hidden');
    if (isHidden) {
      modal.classList.remove('hidden');
      document.documentElement.classList.add('overflow-hidden');
      document.body.classList.add('overflow-hidden');
    } else {
      modal.classList.add('hidden');
      document.documentElement.classList.remove('overflow-hidden');
      document.body.classList.remove('overflow-hidden');
    }
    return;
  }

  // fallback: legacy inline card
  const reportCard = document.getElementById(`report-card-${id}`);
  if (reportCard) {
    reportCard.classList.toggle('hidden');
  }
}