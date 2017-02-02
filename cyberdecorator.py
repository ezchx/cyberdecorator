import scipy
import scipy.misc
import scipy.cluster
from PIL import Image
import json

NUM_CLUSTERS = 3

im = Image.open('uploads/user_file.jpg')

im = im.resize((150, 150))
ar = scipy.misc.fromimage(im)
shape = ar.shape
ar = ar.reshape(scipy.product(shape[:2]), shape[2])

codes, dist = scipy.cluster.vq.kmeans(ar.astype(float), NUM_CLUSTERS)

codes_2 = codes.tolist()
print json.dumps(codes_2)
