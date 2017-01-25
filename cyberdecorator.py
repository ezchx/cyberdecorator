import struct
import scipy
import scipy.misc
import scipy.cluster
from PIL import Image

NUM_CLUSTERS = 3

im = Image.open('van_gogh.jpg')

im = im.resize((150, 150))
ar = scipy.misc.fromimage(im)
shape = ar.shape
ar = ar.reshape(scipy.product(shape[:2]), shape[2])

codes, dist = scipy.cluster.vq.kmeans(ar.astype(float), NUM_CLUSTERS)
print 'cluster centers:\n', codes

vecs, dist = scipy.cluster.vq.vq(ar, codes)         # assign codes
counts, bins = scipy.histogram(vecs, len(codes))    # count occurrences
index_max = scipy.argmax(counts)                    # find most frequent
peak = codes[index_max].astype(int)

color = ''.join(chr(c) for c in peak).encode('hex')
print 'most frequent is %s (#%s)' % (peak, color)
