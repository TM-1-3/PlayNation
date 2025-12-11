function toggleReport(postId) {
  const reportCard = document.getElementById(`report-card-${postId}`);
  if (reportCard) {
    reportCard.classList.toggle('hidden');
  }
}